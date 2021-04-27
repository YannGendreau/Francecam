/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLFormElement} form
 * @property {number} page
 * @property {boolean} more
 */

export default class Filter {

    /**
     * 
     * @param {HTMLElement|null} element 
     */
    /*Si l'élément est null, on retourne*/
    constructor (element) {
        if (element === null) {
            return
        }
        /* Déclaration des sélecteurs */
        this.pagination = element.querySelector('.js-filter-pagination')
        this.sorting = element.querySelector('.js-filter-sorting')
        this.form = element.querySelector('.js-filter-form')
        this.content = element.querySelector('.js-filter-content')
        this.page = parseInt(new URLSearchParams(window.location.search).get('page') || 1)
        this.more = this.page === 1
        this.bindEvents()
    }

        /* Evenements  */
        bindEvents (){
            //au clic sur le "a"
        const aClickListener = e => {
            if(e.target.tagName === 'A'){
            //empèche l'activation du lien
                e.preventDefault()
            //Ajax 
                this.loadUrl(e.target.getAttribute('href'))
            }
            if(e.target.tagName === 'SPAN'){
                e.preventDefault() 
                this.loadUrl(e.target.getAttribute(''))
            }
            if(e.target.tagName === 'I'){
                e.preventDefault() 
                this.loadUrl(e.target.getAttribute(''))
            }
        }

        this.sorting.addEventListener('click', e => {
            aClickListener(e)
            this.page = 1
        })
        if (this.more) {
        this.pagination.innerHTML = '<button class="more">Voir plus</button>'
        this.pagination.querySelector('button').addEventListener('click', this.loadMore.bind(this))
        }else{
        this.pagination.addEventListener('click', aClickListener)
        }
        this.form.querySelectorAll('input[type=checkbox]').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
            
            })
        }
    

    async loadMore () {
        const button = this.pagination.querySelector('button')
        button.setAttribute('disabled', 'disabled')
        this.page++
        const url = new URL(window.location.href)
        const params = new URLSearchParams(url.search)
        params.set('page', this.page)
        await this.loadUrl(url.pathname + '?' + params.toString(), true)
        button.removeAttribute('disabled')
  }

    async loadForm () {
        this.page = 1
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }
    
    

    async loadUrl (url, append = false) {
       const params = new URLSearchParams(url.split('?')[1] || '')
       params.set('ajax', 1)
        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers : {
                'X-Requested-With' : 'XMLHttpRequest'
            }
        })
        if(response.status >= 200 && response.status < 300) {
            const data = await response.json()
            this.sorting.innerHTML = data.sorting
            this.content.innerHTML = data.content
            if (!this.more) {
                this.pagination.innerHTML = data.pagination
            }else if (this.page === data.pages){
                this.pagination.style.display ='none';
            }else{
                this.pagination.style.display =null;
            }
            params.delete('ajax')
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString())
        }else{
            console.error(response)
        }
    }




}

