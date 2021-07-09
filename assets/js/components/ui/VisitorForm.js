const temp = `
    <section class="flex flex-wrap w-6/12 shadow-lg bg-white rounded-lg mt-28 mx-auto block" style="height: 25rem;">
        <div class="w-1/2 visitor-banner rounded-tl-lg rounded-bl-lg p-5">
            <img v-show="profileImage" :src="profileSrc" @error="setDefaultSrc" class="h-32 w-32 mt-1 mx-auto block rounded-tl-full rounded-bl-full rounded-tr-full shadow-2xl"/>
            <span class="mt-32 w-64 fixed block text-center">{{ msgInfo }}</span>
        </div>
        <div class="w-1/2 px-4 mt-8">
            <h4>{{ parseFormLabel[0] }}</h4>
            <span>{{ parseFormLabel[1] }}</span>
            <!-- Form -->
            <!-- MemberID -->
            <label class="block text-md mt-3">{{ parseFormLabel[2] }}</label>
            <input v-on:keypress="checkIn($event)" type="text" ref="memberId" class="bg-gray-300 focus:bg-gray-200 mt-1 rounded-lg py-2 px-3 block w-full visitor-input" :placeholder="parseFormLabel[3]"/>
            <!-- Institution -->
            <label class="block text-md mt-1">{{ parseFormLabel[3] }}</label>
            <input v-on:keypress="checkIn($event)" type="text" ref="institution" class="bg-gray-300 focus:bg-gray-200 mt-1 rounded-lg py-2 px-3 block w-full visitor-input" :placeholder="parseFormLabel[5]"/>
            <label class="block mt-2 text-gray-500 text-sm">{{ parseFormLabel[6] }}</label>
            <!-- Button -->
            <button v-on:click="checkIn" class="w-full block text-white rounded-lg bg-blue-600 hover:bg-blue-400 mt-2 py-2 px-3">Check</button>
        </div>
    </section>
`

export default {
    props: {
        formLabel: String,
        voiceStatus: String,
        defaultLang: String
    },
    name: 'VisitorForm',
    template: temp,
    data() {
        return {
            profileImage: false,
            profileSrc: './images/persons/person.png',
            msgInfo: ''
        }
    },
    computed: {
        parseFormLabel()
        {
            return JSON.parse(this.formLabel.replace(/\'/g, '"'))
        },
    },
    methods: {
        async checkIn(e)
        {
            if (e.type == 'keypress' && e.key !== 'Enter')
            {
                return
            }

            let formData = new FormData()
            let data = this.$refs
            data.memberId.disabled
            data.institution.disabled
            formData.append('memberID', data.memberId.value)
            formData.append('institution', data.institution.value)
            formData.append('counter', 1)

            await fetch('index.php?p=visitor', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                // get Image Profile
                this.getImageProfile(data.memberId.value).then(response => {
                    if (response.status)
                    {
                        this.profileSrc = response.file
                    }
                })

                // set message and profile image
                this.msgInfo = result
                this.profileImage = true
                // make it speach?
                this.makeItSpeachable(result.replace(/(<([^>]+)>)/ig, ''))

                // Wait until 5 seconds
                setTimeout(() => {
                    this.msgInfo = ''
                    this.profileImage = false
                    data.memberId.value = ''
                    data.memberId.focus()
                    data.institution.value = ''
                    this.setDefaultSrc()
                }, 5000);
            })
            .catch(error => {
                console.log(error)
            })
        },
        setDefaultSrc()
        {
            this.profileSrc = './images/persons/person.png'
        },
        async getImageProfile(id)
        {
            const request = await fetch(`index.php?p=api/visitor/person/profile/${id}`)
            const json = await request.json()
            return json
        },
        makeItSpeachable(msg)
        {
            if (this.voiceStatus)
            {
                // Modified from default template
                let message = new SpeechSynthesisUtterance(msg)
                let voices = speechSynthesis.getVoices()
                // console.log(message)
                message['volume'] = 1
                message['rate'] = 1
                message['pitch'] = 1
                message['lang'] = this.defaultLang
                message['voice'] = null
                speechSynthesis.cancel()
                speechSynthesis.speak(message)
            }
        }
    },
    mounted()
    {
    }
}