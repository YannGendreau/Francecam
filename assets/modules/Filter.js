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
    constructor(element) {
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
    bindEvents() {
        const aClickListener = e => {
            // Si la cible du clic est un <a>
            if (e.target.tagName === 'A') {
                //empèche l'activation du lien
                e.preventDefault()
                //Ajax 
                this.loadUrl(e.target.getAttribute('href'))
            }
            // if(e.target.tagName === 'SPAN'){
            //     e.preventDefault() 
            //     this.loadUrl(e.target.getAttribute(''))
            // }
            // if(e.target.tagName === 'I'){
            //     e.preventDefault() 
            //     this.loadUrl(e.target.getAttribute(''))
            // }
        }
        // Change les URLS de filtre quand l'élément sorting est cliqué
        this.sorting.addEventListener('click', e => {
            aClickListener(e)
            this.page = 1
        })
        // if (this.more) {
        // this.pagination.innerHTML = '<button class="more">Voir plus</button>'
        // this.pagination.querySelector('button').addEventListener('click', this.loadMore.bind(this))
        // }else{
        // Change les URLS de pagination quand l'élément pagination est cliqué
        this.pagination.addEventListener('click', aClickListener)
        // }

        // Change les URLs quand les checkboxes sont cochées
        this.form.querySelectorAll('input[type=checkbox]').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))

        })
    }

    async loadMore() {
        const button = this.pagination.querySelector('button')
        button.setAttribute('disabled', 'disabled')
        this.page++
        const url = new URL(window.location.href)
        const params = new URLSearchParams(url.search)
        params.set('page', this.page)
        await this.loadUrl(url.pathname + '?' + params.toString(), true)
        button.removeAttribute('disabled')
    }

    async loadForm() {
        this.page = 1
        // Récupère les données à partir du formulaire
        const data = new FormData(this.form)
        // Récupère l'action en cours ou l'URL en cours
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        // Construit les paramètres d'URL
        const params = new URLSearchParams()
        // Boucle pour parcourir les données du formulaire et les envoyer au params
        data.forEach((value, key) => {
            params.append(key, value)
        })
        // Retourne un json avec le chemin de l'URL (jusqu'au '?') le '?' et les données du formulaire sous forme de chaine de caractères
        return this.loadUrl(url.pathname + '?' + params.toString())
    }



    async loadUrl(url, append = false) {
        // params = découpe de l'URL de la page en cours après le ? et la clé 1 sinon une chaine vide
        const params = new URLSearchParams(url.split('?')[1] || '')
        // Ajoute 'ajax' en valeur 1
        params.set('ajax', 1)
        // récupère l'URL découpé à partir du '?' et la première clé + '?' + params en chaine de caractères => requète XML
        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        // si le status HTTP est success
        if (response.status >= 200 && response.status < 300) {
            //récupère un json de l'url
            const data = await response.json()
            //modifie le DOM des éléments
            this.sorting.innerHTML = data.sorting
            this.content.innerHTML = data.content
            this.pagination.innerHTML = data.pagination
            // if (!this.more) {
            //     this.pagination.innerHTML = data.pagination
            // }else if (this.page === data.pages){
            //     this.pagination.style.display ='none';
            // }else{
            //     this.pagination.style.display =null;
            // }
            //supprime 'ajax' de l'URL
            params.delete('ajax')
            // Remplace l'URL par une URL découpé à partir du '?' et la première clé + '?' + params en chaine de caractères
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString())
        } else {
            console.error(response)
        }
    }




}

