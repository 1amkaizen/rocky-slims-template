const temp = `
    <div class="modal modal-open fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div :class="'mt-20 modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto w-11/12 lg:'+setWidthModal+' xl:'+setWidthModal">
            <div v-on:click="closeModal" class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">{{ title }}</p>
                <div v-on:click="closeModal" class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
                </div>

                <!--Body-->
                <div>
                    
                </div>

                <!--Iframe-->
                <div>
                    <iframe v-if="content === 'Iframe'" :class="'w-full '+modalData?.heightIframeCss" style="border: none" :src="modalData.iframeSrc"></iframe>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                <button v-on:click="closeModal" class="modal-close px-2 bg-indigo-500 p-2 rounded-lg text-white hover:bg-indigo-400">Close</button>
                </div>
            </div>
        </div>
    </div>
`;

// import Citation  from './Citation.js?v=101';

export default {
    props: {
        modalAttribute: {
            type: Object,
            default: () => {
                return {}
            }
        }
    },
    name: 'Modal',
    components: {
        // Citation
    },
    template: temp,
    data() {
        return {
            widthModal: {
                xl:'w-11/12',
                lg:'w-9/12',
                md:'w-7/12' 
            }
        }
    },
    methods: {
        closeModal()
        {
            if (this.$parent.hasOwnProperty('showModal'))
            {
                document.querySelector('body').classList.remove('overflow-hidden');
                this.$parent.showModal = false;
            }
        }
    },
    computed: {
        title()
        {
            if (this.modalAttribute.hasOwnProperty('title'))
            {
                return this.modalAttribute.title;
            }

            return 'NoTitle';
        },
        content()
        {
            if (this.modalAttribute.hasOwnProperty('content'))
            {
                return this.modalAttribute.content;
            }

            return 'NoContent';
        },
        setWidthModal()
        {
            if (this.modalAttribute.hasOwnProperty('modalWidth'))
            {
                return (this.widthModal.hasOwnProperty(this.modalAttribute.modalWidth)) ? 
                        this.widthModal[this.modalAttribute.modalWidth] 
                        : 
                        this.widthModal['md'];
            }

            return this.widthModal['md'];
        },
        modalData() {
            if (this.modalAttribute.hasOwnProperty('data'))
            {
                return this.modalAttribute['data'];
            }

            return {};
        }
    }
}