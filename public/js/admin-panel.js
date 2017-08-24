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
     * Handle deleting submission and hiding row
     * @param  {Event} e 
     * @return {Void}   
     */
    function handleDeleteSubmissions(e) {
        if(!confirm(m.message.confirm)) return
        common().handleSubmit(e)
        .then(_ => $(e.target).parents('tr').hide())
        .fail(response => showErrors(response.responseJSON))
    }

    /**
     * Handle update of profs/schools details
     * @param  {Event} e form submit
     * @return {Void}   
     */
    function handlePageUpdate(e) {
        common().handleSubmit(e)
        .then(_ => {
            const correctionsID = $(e.target).find('input[name="corrections_id"]').val(),
                  itemRow = $(`tr[data-correction="${correctionsID}"`)
            $(e.target).parents('.modal').modal('hide')
            itemRow.hide()
        })
        .fail(response => common().displayErrors(e.target, response.responseJSON))
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


    function loadInfoToModal(e) {
        let row = $(e.target).parents('tr'),
            type = e.target.getAttribute('data-type'),
            modal = document.querySelector(`form[data-id="${type}"]`)

        modal.id.value = row.find('a[data-id]').data('id')

        if(type == 'prof') { 
           const data = m.edit.data.filter(item => item.lastname && item.id == modal.id.value)
           if(data.length > 0) {
                modal.firstname.value = data[0].name
                modal.lastname.value = data[0].lastname
                modal.directory.value = data[0].directory_url
                modal.dID.value = data[0].deptID
                modal.department.value = data[0].department
                modal.school.value = data[0].school
                modal.sID.value = data[0].schoolID
                modal.corrections_id.value = row.data('correction')
           }
        }else {
            const data = m.edit.data.filter(item => item.location && item.id == modal.id.value)
            if(data.length > 0) {
                modal.name = data[0].name
            }
        }
    }

    function activateTypeahead() {
        common().activateTypeahead($('#editPage form[data-id="prof"]'), m.edit.data)
    }

    function bindUIEvents() {
        $('.modal').on('shown.bs.modal', activateTypeahead)
        $('.modal input').on('change keydown input', common().clearErrors)
        document.querySelectorAll('#profs button')
                .forEach(btn => btn.addEventListener('click', handleSubmission))
        document.querySelectorAll('form.delete')
                .forEach(form => form.addEventListener('submit', handleDeleteSubmissions))
        document.querySelectorAll('button[data-id="edit"]')
                .forEach(btn => btn.addEventListener('click', loadInfoToModal))
        document.querySelectorAll('#editPage form')
                .forEach(form => form.addEventListener('submit', handlePageUpdate))
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