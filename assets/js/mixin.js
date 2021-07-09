export default {
    data() {
        return {
            doc: document,
            body: document.body,
            lastKeywordsBox: false,
            boxMt: 'md:mt-14 lg:mt-14 xl:mt-14',
            boxMt2: '',
            totalReserve: (localStorage.getItem('reservationBook') !== null) ? JSON.parse(localStorage.getItem('reservationBook')).length : 0,
            reserveTotal: true,
        }
    },
    methods:
    {
        baseUrl(additionalUrl = '')
        {
            let url = this.doc.querySelector('meta[name="url"]').getAttribute('content');
            return url + additionalUrl;
        },
        pinkoUrl(additionalUrl = '')
        {
            return this.baseUrl(`template/pinko/` + additionalUrl);
        },
        thumbUrl(fileName)
        {
            let fixFileName = fileName
            
            if (fileName === '')
            {
                fixFileName = 'image.png'
            }
            return `index.php?p=api/cover/book/250/600/${fixFileName}`
        },
        onClick(ev) {

        },
        scrolling(height)
        {
            scroll({
                top: height,
                behavior: 'smooth'
            });
        },
        findPos(obj) {
            var curtop = 0;
            if (obj.offsetParent) {
                do {
                    curtop += obj.offsetTop;
                } while (obj = obj.offsetParent);
                    return curtop;
            }
        },
        setLastKeywords(keywords)
        {
            if (keywords.length === 0)
            {
                return
            }
            
            if (localStorage.getItem('lastKeywords') === null)
            {
                localStorage.setItem('lastKeywords', JSON.stringify([]))
            }
            
            let lastKeywords = JSON.parse(localStorage.getItem('lastKeywords'))
            let escapeKeyword = keywords.replace(/[^A-Za-z0-9:\s+]/g, '')

            let isSetLastKeyword = false
            lastKeywords.forEach(word => {
                if (keywords === word)
                {
                    isSetLastKeyword = true
                }
            })

            if (!isSetLastKeyword)
            {
                lastKeywords.push(escapeKeyword)
            }

            // store again
            localStorage.setItem('lastKeywords', JSON.stringify(lastKeywords))
        },
        removePreloader()
        {
            // Loader
            let loader = document.querySelector('.preloader');
            let body = document.querySelector('body');

            if (loader !== null)
            {
                loader.classList.add('animate__animated', 'animate__fadeOut', 'animate__delay-2s');

                setTimeout(() => {
                    loader.classList.add('hidden');
                    body.classList.remove('overflow-hidden');
                }, 2500);
            }
        },
        getEnv()
        {
            if (this.doc.querySelector('meta[name="env"]') !== null)
            {
                return this.doc.querySelector('meta[name="env"]').getAttribute('content');
            }

            return 'production';
        },
        qSelect(selector)
        {
            return this.doc.querySelector(selector)
        },
        qSelectAll(selector)
        {
            return this.doc.querySelectorAll(selector)
        },
        checkProp(obj, prop)
        {
            if (typeof obj === 'object')
            {
                return obj.hasOwnProperty(prop)
            }
            return false
        },
        toastr(msg, title, type, pos = 'bottom')
        {
            let options = {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: false,
                positionClass: `toast-${pos}-right`,
                preventDuplicates: false,
                onclick: null,
                showDuration: 300,
                hideDuration: 1000,
                timeOut: 5000,
                extendedTimeOut: 1000,
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            }

            toastr[type](msg, title, options)
        }
    },
    mounted() {
        // // Attach event listener to the root vue element
        // this.$el.addEventListener('click', this.onClick)
        // // loader
        this.removePreloader();
    },
    beforeDestroy() {
        // this.$el.removeEventListener('click', this.onClick)
        // document.removeEventListener('click', this.onClick)
    },
}