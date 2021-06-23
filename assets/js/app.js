// function
function isSelectorActive(selector)
{
    return (document.querySelector(selector) !== null) ? true : false;
}


// Components
import {Newbook} from './components/splide/index.js';
import {Searchbox, Advancesearch} from './components/ui/index.js';

// Global scope
Vue.mixin({
    data() {
        return {
            doc: document,
            body: document.body,
            lastKeywordsBox: false,
            boxMt: 'md:mt-14 lg:mt-14 xl:mt-14',
            boxMt2: '',
            totalReserve: (localStorage.getItem('reservationBook') !== null) ? JSON.parse(localStorage.getItem('reservationBook')).length : 0,
            reserveTotal: true
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
            return `index.php?p=api/cover/book/250/600/${fileName}`
        },
        onClick(ev) {

        },
        scrolling(selector)
        {
            scroll({
                top: (this.findPos(document.querySelector(selector)) - 150),
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
        removePreloader()
        {
            // Loader
            let loader = document.querySelector('#preloader');
            let body = document.querySelector('body');

            loader.classList.add('animate__animated', 'animate__fadeOut', 'animate__delay-2s');

            setTimeout(() => {
                loader.classList.add('hidden');
                body.classList.remove('overflow-hidden');
            }, 2500);
        },
        getEnv()
        {
            if (this.doc.querySelector('meta[name="env"]') !== null)
            {
                return this.doc.querySelector('meta[name="env"]').getAttribute('content');
            }

            return 'production';
        }
    },
    mounted() {
        // // Attach event listener to the root vue element
        // this.$el.addEventListener('click', this.onClick)
        // // loader
        // this.removePreloader();
    },
    beforeDestroy() {
        // this.$el.removeEventListener('click', this.onClick)
        // document.removeEventListener('click', this.onClick)
    },
})

// Instances

if (isSelectorActive('#landingPage'))
{
    const landingPage = new Vue({
        el: '#landingPage',
        components: {
            Newbook
        }
    })
}

if (isSelectorActive('#navbar'))
{
    const nav = new Vue({
        el: '#navbar',
        components: {
            Searchbox
        }
    })
}

if (isSelectorActive('#advanceSearch'))
{
    const nav = new Vue({
        el: '#advanceSearch',
        components: {
            Advancesearch
        }
    })
}