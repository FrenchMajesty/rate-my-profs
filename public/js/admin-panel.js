$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
})

/*
    ###########################################################################
    ## CommonPanel
    ###########################################################################
    #
    # This object is used for all basic and repetitive operations performed in
    # the application's admin panel to avoid code repeat
    #
    */
const commonPanel = function() {
    const module = {},
          _this = {}

     /**
     * Load professor/school data into the modal opened
     * @param  {Event} e event
     * @param {JSON} allData content data
     * @return {Void}   
     */
     module.loadInfoToModal = (e, allData) => {
        let row = $(e.target).parents('tr'),
            type = e.target.getAttribute('data-type'),
            modal = document.querySelector(`form[data-id="${type}"]`)

        $('#editPage form').css('display','none')
        modal.removeAttribute('style')
        modal.id.value = row.find('a[data-id]').data('id') || row.data('item-id')

        if(type == 'prof' || type == 'prof-approve' || type == 'prof-update') { 
           const data = allData.filter(item => item.lastname && item.id == modal.id.value)
           if(data.length > 0) {
                modal.firstname.value = data[0].name
                modal.lastname.value = data[0].lastname
                modal.directory.value = data[0].directory_url
                modal.dID.value = data[0].deptID
                modal.department.value = data[0].department
                modal.school.value = data[0].school
                modal.sID.value = data[0].schoolID
                if(!type.match(/-/)) // If is a correction
                    modal.corrections_id.value = row.data('correction')
           }
        }else {
            const data = allData.filter(item => item.location && item.id == modal.id.value)
            if(data.length > 0) {
                modal.name.value = data[0].name
                modal.nickname.value = data[0].nickname
                modal.location.value = data[0].location
                modal.website.value = data[0].website
                if(!type.match(/-/)) // If is a correction
                    modal.corrections_id.value = row.data('correction')
            }
        }
    }

    /**
     * Handle update of profs/schools details
     * @param  {Event} e event
     * @return {Void}   
     */
    module.handlePageUpdate = (e) => {
        common().handleSubmit(e)
        .then(_ => {
            let formID = e.target.getAttribute('data-id'),
                itemRow = undefined,
                itemID = undefined

            if(formID == 'school' || formID == 'prof') {
                itemID = e.target.corrections_id.value
                itemRow = $(`tr[data-correction="${itemID}"`)

            }else if(formID == 'prof-approve') {
                itemID = e.target.id.value
                itemRow = $(`#profs tr[data-item-id="${itemID}"]`)

            }else if(formID == 'school-approve') {
                itemID = e.target.id.value
                itemRow = $(`#schools tr[data-item-id="${itemID}"]`)
            }
            $(e.target).parents('.modal').modal('hide')
            itemRow.hide()
        })
        .fail(response => common().displayErrors(e.target, response.responseJSON))
    }

    return module
}

/*
    |--------------------------------------------------------------------------
    | - Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the 
    | 
    |
    */
   
const t = (function() {
    const m = {}

    function bindUIEvents() {

    }

    m.init = (config) => {
        if(config) {
            Object.keys(config).forEach(key => {
                if(m.hasOwnProperty(key)) Object.assign(m[key], config[key])
            })
        }

        bindUIEvents()
    }

    return m
}())


/*
    |--------------------------------------------------------------------------
    | Dashboard Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the dashboard page
    | like form handling on the modals and data loading
    |
    */
   
const Dashboard = (function() {
    const m = { 
        message: { confirm: null },
        url: { approve: null },
        edit: { data: null }
    }

    /**
     * Approve or reject a submission
     * @param {Event} e event
     * @return {Void}
     */
    function handleSubmission(e) {
        if(!confirm(m.message.confirm)) return
        e.preventDefault()

        const action = e.target.getAttribute('data-action'),
              row = $(e.target).parents('tr'),
              form = $(e.target).parents('form')

        form.append(`<input type="hidden" name="action" value="${action}">`)

        const formData = new FormData(form[0])
        $.ajax(form.attr('action'), {
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        .then(_ => row.hide())
        .fail(response => showErrors(response.responseJSON))
    }

     /**
     * Handle deleting submission and hiding row
     * @param  {Event} e event
     * @return {Void}   
     */
    function handleDeleteSubmissions(e) {
        if(!confirm(m.message.confirm)) return

        common().handleSubmit(e)
        .then(_ => $(e.target).parents('tr').hide())
        .fail(response => showErrors(response.responseJSON))
    }

    /**
     * Handle the submit of form to dismiss a report
     * @param  {Event} e event
     * @return {Void}   
     */
    function handleReportAction(e) {
        common().handleSubmit(e)
        .then(_ => {
            $(e.target).parents('.modal').modal('hide')
            $(`#reports tr[data-report="${e.target.reports_id.value}"]`).hide()
        })
        .fail(response => common().displayErrors(e.target, response.responseJSON))
    }

    /**
     * Extract and show errors
     * @param  {JSON} errors errors
     * @return {Void}        
     */
    function showErrors(errors) {
        let text = ''
        
        Object.keys(errors).forEach(key => {
            if(typeof key == 'string')
                text += `${errors[key]}\n`
            else
                errors[key].forEach(err => text += `${err}\n`)
        })
        alert(text)    
    }

    /**
     * Load rating info into the modal opened
     * @param  {Event} e event
     * @return {Void}   
     */
    function loadRatingToModal(e) {
        const row = $(e.target).parents('tr'),
              modal = document.querySelector('#viewReports form')

        modal.querySelector('#target').value = row.find('td[data-id="name"]').text()
        modal.querySelector('#rating').innerText = row.find('input[name="comment"]').val()
        modal.id.value = row.find('input[name="id"]').val()
        modal.reports_id.value = row.data('report')
        modal.type.value = row.data('type')
    }  

    /**
     * Activate typeahead on professor update form
     * @return {Void} 
     */
    function activateTypeahead() {
        const inputContainer = $('#editPage')
        common().activateTypeahead(inputContainer, m.edit.data)
    }

    function bindUIEvents() {
        $('.modal').on('shown.bs.modal', activateTypeahead)
        $('.modal input').on('change keydown input', common().clearErrors)
        document.querySelector('#viewReports form').addEventListener('submit', handleReportAction)
        document.querySelectorAll('#profs form button')
                .forEach(btn => btn.addEventListener('click', handleSubmission))
        document.querySelectorAll('#schools form button')
                .forEach(btn => btn.addEventListener('click', handleSubmission))
        document.querySelectorAll('#profRating form button')
                .forEach(btn => btn.addEventListener('click', handleSubmission))
        document.querySelectorAll('#schoolRating form button')
                .forEach(btn => btn.addEventListener('click', handleSubmission))
        document.querySelectorAll('form.delete')
                .forEach(form => form.addEventListener('submit', handleDeleteSubmissions))
        document.querySelectorAll('button[data-id="edit"]')
                .forEach(btn => btn.addEventListener('click',(e) => { commonPanel().loadInfoToModal(e, m.edit.data) }))
        document.querySelectorAll('#schools button[data-type]')
                .forEach(btn => btn.addEventListener('click',(e) => { commonPanel().loadInfoToModal(e, m.edit.data) }))
        document.querySelectorAll('#profs button[data-type]')
                .forEach(btn => btn.addEventListener('click',(e) => { commonPanel().loadInfoToModal(e, m.edit.data) }))
        document.querySelectorAll('#editPage form')
                .forEach(form => form.addEventListener('submit', commonPanel().handlePageUpdate))
        document.querySelectorAll('button[data-id="reviewReports"]')
                .forEach(btn => btn.addEventListener('click', loadRatingToModal))
        document.querySelector('#viewReports .modal-footer button[data-type="dismiss"]')
        .addEventListener('click', () => $('#viewReports form').find('[name="action"]').val('dismiss'))
        document.querySelector('#viewReports .modal-footer button[type="submit"]')
        .addEventListener('click', () => $('#viewReports form').find('[name="action"]').val('remove'))
        document.querySelector('.card-stats a[href="#submissions"]')
                .addEventListener('click',() => $('.nav-tabs a[href="#submissions"]').click())
    }

    m.init = (config) => {
        if(config) {
            Object.keys(config).forEach(key => {
                if(m.hasOwnProperty(key)) Object.assign(m[key], config[key])
            })
        }

        bindUIEvents()
    }

    return m
}())

/*
    |--------------------------------------------------------------------------
    | Content Manager Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the content managers
    | pages like form handling for editing and the modals
    |
    */
const ContentManager = (function() {
    const m = {
        message: { confirm: null, warning: null },
        edit: { data: null, fetchUrl: null }
    }
    
    function handleDelete(e) {
        if(!confirm(m.message.confirm)) return
        // Extra warning for deleting schools
        if($('#schools')[0] && !confirm(m.message.warning)) return

        const form = $(e.target).parents('form'),
              formData = new FormData(form[0])

        $.ajax(form.attr('action'), {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
        .then(_ => $(e.target).parents('tr').hide())
        .fail(response => common().displayErrors(e.target, response.responseJSON))
    }

    /**
     * Activate typeahead on professor update form
     * @return {Void} 
     */
    function activateTypeahead() {
        const inputContainer = $('#editPage')
        common().activateTypeahead(inputContainer, m.edit.data)
    }

    function bindUIEvents() {
        $('.modal').on('shown.bs.modal', activateTypeahead)
        $('input').on('change input keydown', common().clearErrors)
        document.querySelectorAll('.td-actions form button')
                .forEach(btn => btn.addEventListener('click', handleDelete))
        document.querySelectorAll('.td-actions [data-type]')
                .forEach(btn => btn.addEventListener('click',(e) => { commonPanel().loadInfoToModal(e, m.edit.data) }))
        document.querySelectorAll('#editPage form')
                .forEach(form => form.addEventListener('submit', commonPanel().handlePageUpdate))
    }

    m.init = (config) => {
        if(config) {
            Object.keys(config).forEach(key => {
                if(m.hasOwnProperty(key)) Object.assign(m[key], config[key])
            })
        }

        bindUIEvents()
    }

    return m
}())
