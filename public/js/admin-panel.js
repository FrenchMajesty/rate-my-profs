$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
})

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
    | like form handling
    |
    */
   
const Dashboard = (function() {
    const m = { 
        message: { confirm: null },
        url: { approve: null }
    }

    /**
     * Approve or reject a submission
     * @param {Event} e event
     * @return {Void}
     */
    function handleSubmission(e) {
        if(!confirm(m.message.confirm)) return
        e.preventDefault()

        const action = e.target.getAttribute('data-id'),
              row = $(e.target).parents('tr'),
              form = $(e.target).parents('form')

        form.append(`<input type="hidden" name="action" value="${action}">`)

        const formData = new FormData(form[0])
        $.ajax(m.url.approve, {
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        .then(_ => row.hide())
        .fail(response => showErrors(response.responseJSON))
    }

    /**
     * Extract and show errors
     * @param  {JSON} errors 
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

    function bindUIEvents() {
        document.querySelectorAll('#profs button')
                .forEach(form => form.addEventListener('click', handleSubmission))
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