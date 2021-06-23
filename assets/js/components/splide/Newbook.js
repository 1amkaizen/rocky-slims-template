const temp = `
    <section class="block mt-4 mx-auto w-full">
        <div ref="splide" class="splide in-zi">
            <div class="splide__track w-11/12 mx-auto">
                <ul class="splide__list">
                    <li class="splide__slide h-auto w-32" v-for="(slide,index) in slides">
                        <a :href="baseUrl('index.php?p=show_detail&id='+slide.biblio_id)" class="shadow-2xl" :title="slide.title">
                            <img :src="thumbUrl(slide.image)" class="rounded-lg h-48 mx-10 w-32"/>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="splide__progress mt-6 mb-10">
                <div class="splide__progress__bar">
                </div>
            </div>
        </div>
    </section>
`;

export default {
    name: 'Autoplay',
    template: temp,
    props: {
        perShow: {
            type: Number,
            default: 8
        },
        autoPlay: {
            type: Boolean,
            default: true
        },
        sliderType: {
            type: String,
            default: 'loop'
        },
        sliderGap: {
            type: String,
            default: '2em'
        }
    },
    data()
    {
        return {
            slides: []
        }
    },
    methods: {
        async createSlide()
        {
            await fetch('?p=api/newbook')
                .then(response => response.json())
                .then(result => {
                    if (result.length)
                    {
                        console.log(this.sliderType)
                        this.slides = result;
                        setTimeout(() => {
                            new Splide(this.$refs.splide, {
                                type: this.sliderType,
                                rewind: (this.sliderType === 'slide') ? true : false,
                                perPage: this.perShow,
                                pagination: false,
                                autoplay: this.autoPlay,
                                gap: this.sliderGap
                            }).mount();
                        }, 500);
                    }
                });
        },
    },
    mounted()
    {
        this.createSlide();
    }
}
