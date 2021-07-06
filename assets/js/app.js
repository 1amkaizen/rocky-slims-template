// function
function isSelectorActive(selector)
{
    return (document.querySelector(selector) !== null) ? true : false
}

// get Mark
function getMarkNum()
{
    if (localStorage.getItem('biblioMark') !== null)
    {
        return Object.keys(JSON.parse(localStorage.getItem('biblioMark'))).length
    }

    return 0
}

// Vanila function
function openDropDown(obj)
{
    console.log(obj)
}

// Components
import {Newbook, Popular} from './components/splide/index.js'
import {Searchbox, Advancesearch, Lang, 
        Titlehighlight, Buttontwice, Modal, 
        Buttonbasket, Basket, Basketlist, Banner} from './components/ui/index.js'

// import mixin
import objectMixin from './mixin.js'

// Global scope
Vue.mixin(objectMixin)

// set Vuex
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        biblioMark: getMarkNum()
    },
    mutations: {
        increment (state) {
            state.biblioMark += 1
        },
        decrement (state) {
            state.biblioMark -= 1
        }
    }
})

// Instances

if (isSelectorActive('#landingPage'))
{
    const landingPage = new Vue({
        el: '#landingPage',
        components: {
            Newbook,
            Popular,
            Banner
        }
    })
}

if (isSelectorActive('#navbar'))
{
    const navbar = new Vue({
        el: '#navbar',
        components: {
            Searchbox,
            Lang,
            Basket
        },
        store,
        data: {
            nomor: 0
        }
    })
}

if (isSelectorActive('#advanceSearch'))
{
    const advanceSearch = new Vue({
        el: '#advanceSearch',
        components: {
            Advancesearch
        }
    })
}

if (isSelectorActive('#appDetail'))
{
    const app = new Vue({
        el: '#appDetail',
        components: {
            Titlehighlight,
            Buttontwice,
            Buttonbasket,
            Modal,
            Basketlist
        },
        store,
        data: {
            showModal: false,
            modalAttribute: {}
        }
    })
}