const temp = `
    <span class="block text-center book-title font-bold mt-1 px-2 text-md" v-html="titleHiglighted"></span>
`;


export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        keywords: {
            type: String,
            default: ''
        }
    },
    name: 'Titlehighlight',
    template: temp,
    computed: {
        titleHiglighted()
        {
            if (this.keywords !== '')
            {
                let chunkTitle = this.title.split(' ');
                let regex = new RegExp(this.keywords, 'gi');
                let fixTitle = '';

                chunkTitle.forEach((title, index) => {
                    if (title.match(regex))
                    {
                        fixTitle += `<b class="rocky-base-bg-color p-1 text-white rounded-sm">${title}</b> `;
                    }
                    else
                    {
                        fixTitle += `${title} `;
                    }
                })

                return fixTitle;
            }

            return this.title;
        }
    }
    
}