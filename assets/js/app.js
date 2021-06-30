// function
function isSelectorActive(selector)
{
    return (document.querySelector(selector) !== null) ? true : false
}

// Vanila function
function openDropDown(obj)
{
    console.log(obj)
}

// Components
import {Newbook, Popular} from './components/splide/index.js'
import {Searchbox, Advancesearch, Lang} from './components/ui/index.js'

// import mixin
import objectMixin from './mixin.js'

// Global scope
Vue.mixin(objectMixin)

// Instances

if (isSelectorActive('#landingPage'))
{
    const landingPage = new Vue({
        el: '#landingPage',
        components: {
            Newbook,
            Popular
        }
    })
}

if (isSelectorActive('#navbar'))
{
    const nav = new Vue({
        el: '#navbar',
        components: {
            Searchbox,
            Lang
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