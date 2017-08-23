/*
    |--------------------------------------------------------------------------
    | Sign Up Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the registration page
    | like changing card and form handling
    |
    */
const signUp = (function () {
    const m = {}

    m.settings = {
        switcher : document.querySelector('.switch'),
        signUpContainer: $('#signup-container'),
        defaultCard: $('.card[data-card="student"]'),
        successRegisterRedirectUrl: './account'
    }

    function handleSubmit(e) {
        e.preventDefault()

        const url = e.target.getAttribute('action'),
               formData = new FormData(e.target)

        $.ajax(url, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
        .then(response => window.location.replace(m.settings.successRegisterRedirectUrl))
        .fail(response => displayErrors(e.target, response.responseJSON))
    }

    /**
     * Display AJAX form errors in card
     * @param  {Element} elem
     * @param  {JSON} errors
     */
    function displayErrors(elem, errors) {
        const errorDiv = elem.querySelector('.alert-danger')
              errorDiv.removeAttribute('style')

        Object.keys(errors).forEach(err => {
            errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
        })
    }

    /**
     * Clear the errors in card
     * @param  {Element} elem
     */
    function clearErrors(elem) {
        const errorDiv = elem.querySelector('.alert-danger')
              errorDiv.setAttribute('style', 'display: none')
              errorDiv.innerHTML = ''
    }

    function changeSignup(e) {
        if(!e.target.type) return
        let card = null

        if($(e.target).is(':checked'))
            card = $('.card[data-card="prof"]').clone(true)
        else
            card = $('.card[data-card="student"]').clone(true)

        replaceSignup(card)
    }

    /**
     * Replace the current sign up card
     * @param  {Element} new card
     */
    function replaceSignup(card) {
        m.settings.signUpContainer.children().first().remove()
        m.settings.signUpContainer.html(card)
        card.addClass('wow animated fadeInDown')
        card.find('form').on('submit', handleSubmit)
        card.find('input').on('change keydown keypress',(e) => clearErrors(card[0]))

        // Hide all, show the one wanted
        document.querySelectorAll('ul[data-id]').forEach(list => $(list).css('display','none'))
        $(`ul[data-id="${card.attr('data-card')}"]`).css('display','')
    }

    function bindUIEvents() {
        m.settings.switcher.addEventListener('click', changeSignup)
    }

    m.init = () => {
        bindUIEvents()
        replaceSignup(m.settings.defaultCard.clone(true))
    }

    return m
}())


/*
    |--------------------------------------------------------------------------
    | Login Script Module
    |--------------------------------------------------------------------------
    |
    | This module is for all operations performed on the login page like the
    | form handling and the animation
    |
    */
const loginScript = (function() {
    const m = {}

    m.settings = {
        container: $('#card-container'),
        successLoginRedirectUrl: './profile',
        successEmailLinkRedirectUrl : './login'
    }

    function handleLogin(e) {
        e.preventDefault()

        const formData = new FormData(e.target),
              url = e.target.getAttribute('action')
        
        $.ajax(url, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
        .then(_ => window.location.replace(m.settings.successLoginRedirectUrl))
        .fail(response => displayErrors(e.target, response.responseJSON))
    }

    function handlePwdReset(e) {
        e.preventDefault()

        const formData = new FormData(e.target),
              url = e.target.getAttribute('action')
        
        $.ajax(url, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
        .then(_ => { 
            alert('A reset link associated with that email has been sent.')
            window.location.replace(m.settings.successEmailLinkRedirectUrl)
        })
        .fail(response => displayErrors(e.target, response.responseJSON))
    }

    /**
     * Display AJAX form errors in vue
     * @param  {Element} elem
     * @param  {JSON} errors
     */
    function displayErrors(elem, errors) {
        const errorDiv = elem.querySelector('.alert-danger')
              errorDiv.removeAttribute('style')

        Object.keys(errors).forEach(err => {
            if(typeof errors[err] == 'string')
                errorDiv.innerHTML += `<li>${errors[err]}</li>`
            else 
                errors[err].forEach(msg => errorDiv.innerHTML += `<li>${msg}</li>`) 
        })
    }

    /**
     * Clear the errors in vue
     * @param  {Element} elem
     */
    function clearErrors(elem) {
        const errorDiv = elem.querySelector('.alert-danger')
              errorDiv.setAttribute('style', 'display: none')
              errorDiv.innerHTML = ''
    }

    /**
     * Change the current view
     * @param {String} name
     */
    function setVue(name) {
        const container = m.settings.container,
              template = document.querySelector(`#temp div[data-card="${name}"]`),
              vue = $(template).clone(true),
              animation = name == 'login' ? 'fadeInDown' : 'fadeInDown'

        container.children().first().remove()
        container.html(vue)
        vue.addClass(`animated ${animation}`)
        bindEvents(vue[0])
    }

    /**
     * Attach the events on a newly generated vue
     * @param  {String} vue
     */
    function bindEvents(vue) {

        vue.querySelector('a[data-type="nav"]').addEventListener('click', (e) => { 
            setVue(e.target.getAttribute('data-id')) 
        })

        if(vue.getAttribute('data-card') == 'login') {
            vue.querySelector('form').addEventListener('submit', handleLogin)
            $(vue).find('input').on('change keydown keypress',(e) => { clearErrors(vue) })
        }else {
            vue.querySelector('form').addEventListener('submit', handlePwdReset)
            $(vue).find('input').on('change keydown keypress',(e) => { clearErrors(vue) })
        }
    }

    m.init = (config) => {
        setVue('login')
    }

    return m

}())

/*
    |--------------------------------------------------------------------------
    | Reset Password Script Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the reset password page
    | like form handling
    |
    */
const resetPasswordScript = (function() {
    const m = {}

    m.settings = {
        form: document.querySelector('.card-block form'),
        successUpdatePasswordRedirectUrl: '../../login'
    }

    function handleSubmit(e) {
        e.preventDefault()

        const url = e.target.getAttribute('action'),
               formData = new FormData(e.target)

        $.ajax(url, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false
        })
        .then(response => {
            alert('Your password was succesfully updated!')
            window.location.replace(m.settings.successUpdatePasswordRedirectUrl)
        })
        .fail(response => displayErrors(response.responseJSON))
    }

    /**
     * Display AJAX form errors on page
     * @param  {JSON} errors
     */
    function displayErrors(errors) {
        const errorDiv = m.settings.form.querySelector('.alert-danger')
              errorDiv.removeAttribute('style')

        Object.keys(errors).forEach(err => {
            errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
        })
    }

    /**
     * Clear the errors on page
     */
    function clearErrors() {
        const errorDiv = m.settings.form.querySelector('.alert-danger')
              errorDiv.setAttribute('style', 'display: none')
              errorDiv.innerHTML = ''
    }

    function bindUIEvents() {
        m.settings.form.addEventListener('submit', handleSubmit)
        $(m.settings.form).find('input').on('change keypress keydown', clearErrors)
    }

    m.init = () => {
        bindUIEvents()
    }

    return m
}())