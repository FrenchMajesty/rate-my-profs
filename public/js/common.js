/*
    ###########################################################################
    ## Common
    ###########################################################################
    #
    # This object is used for all basic and repetitive operations performed in
    # the application to avoid code repeat
    #
    */
const common = () => {
    const _this = {}

    /**
     * Handle the submit of a general form
     * @param  {Event} e 
     * @return {Void}
     */
    _this.handleSubmit = (e) => {
        e.preventDefault()

        const url = e.target.getAttribute('action'),
              formData = new FormData(e.target)

        return $.ajax(url, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
    }

    /**
     * Show errors in an element
     * @param  {Element} elem   
     * @param  {JSON} errors
     * @return {Void} 
     */
    _this.displayErrors = (elem, errors) => {
        const errorDiv = elem.querySelector('.error')
        errorDiv.classList.add('alert','alert-danger')

        Object.keys(errors).forEach(key => {
            if(typeof key == 'string') 
                errorDiv.innerHTML += `<li>${errors[key]}</li>`
            else
                errors[key].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
        })  
    },

    /**
     * Clear the errors shown in a form if any
     * @param  {Event} e
     * @return {Void}
     */
    _this.clearErrors = (e) => {
        const errorDiv = $(e.target).parents('form').find('.error')
        errorDiv.removeClass('alert alert-danger').html('')
    }

    /**
     * Pass data to typeahead inputs
     * @param  {JQuery} card current card
     * @param {Array} data
     * @return {Void}
     */
    _this.activateTypeahead = (card, data) => {
        const cardName = card.data('id')
        const content = {
            profs: data.filter(item => item.lastname),
            schools: data.filter(item => item.location)
         }

        card.find('input[name="school"]:visible').typeahead(_this.TypeaheadSettings(card, 'school', content))
        card.find('input[name="prof"]:visible').typeahead(_this.TypeaheadSettings(card, 'prof', content))
    }

    /**
     * Generate typeahead settings
     * @param {String} card  Current card
     * @param {String} input Name of the input the settings are for
     * @param {Array} data  Data to preload onto input
     * @return {Object} Typeahead settings
     */
    _this.TypeaheadSettings = (card, input, data) => {
        const profID = card.find(`input[name="pID"]`),
              schoolID = card.find(`input[name="sID"]`)

        if(input == 'prof') {
            return {
                source: data.profs, minLength: 3,items: 4,
                displayText: function(item) {
                    const format = card.find('input[name="prof"]').data('format')

                    return format == 'full' ?
                              `${item.name} ${item.lastname} - ${item.school}`
                            : `${item.name} ${item.lastname}`
                },
                afterSelect: function (item) {
                    profID.val(item.id)
                }
            }
        }else if(input == 'school') {
            return {
                source: data.schools, minLength: 3, items: 4,
                displayText: function(item) {
                    return `${item.name} (${item.nickname}), ${item.location}`
                },
                afterSelect: function (item) {
                    schoolID.val(item.id)
                    if(card.data('id') == 'profs') _this.filterProfessorData(card, data.profs, item.id)
                }
            }   
        }
    }

    /**
     * Filter professor data on input by school ID
     * @param {JQuery} card container where search is performed
     * @param  {Int} schoolID 
     * @return {Void} 
     */
    _this.filterProfessorData = (card, data, schoolID) => {
        const profInput = card.find('input[name="prof"]'),
              profs = data.filter(item => item.school_id == schoolID)

        profInput.typeahead('destroy')
        profInput.typeahead(_this.TypeaheadSettings(card, 'prof',{profs: profs}))
    }

    /**
     * Load location dropdown in search utilities
     * @param  {Array} data    Schools data
     * @param {Object} options Required params for the input
     * @param {JQuery} options.dropdown Locations dropdown
     * @param {String} options.searchUrl URL where to search on click
     * @return {Void}         
     */
    _this.loadLocations = (data, options) => {
        let locations = data.filter(item => item.location)
            locations = Array.from(new Set(locations))

        if(locations.length > 0) options.dropdown.html('')
        locations.forEach(itm => {
            options.dropdown.append(`<a class="dropdown-item" href="${options.searchUrl}?search=${itm.location}">
                                ${itm.location}</a>`)
        })
    }

    return _this
}