<div class="__web_info" id="__web_info">
    <h2>Керування інформацією на сайті</h2>
    <hr>
    <p>Саме в цьому модулі Ви можете змінити інформацію, яка є на Вашому сайті. Наприклад, таку інформацію, як
     назва сайту, опис або ключові слова сайту.
    </p>
    <hr>
    <fieldset>
        <legend>
            Інформація про сайт
        </legend>
        <div class='form-group'>
            <input class='form-control' type="text" v-model="websiteInfo.title" @input="createButton('title')">
            <button class='btn btn-success' v-if="hiddenButtons.title" @click="saveConfiguration('title')">Зберегти</button>
        </div>
        <div class='form-group'>
            <textarea class='form-control' v-model="websiteInfo.description" @input="createButton('desc')"></textarea>
            <button class='btn btn-success' v-if="hiddenButtons.desc" @click="saveConfiguration('description')">Зберегти</button>
        </div>
        <div class='form-group'>
            <input class='form-control' type="text" v-model="websiteInfo.keywords" @input="createButton('keys')">
            <button class='btn btn-success' v-if="hiddenButtons.keys" @click="saveConfiguration('keywords')">Зберегти</button>
        </div>
        <div class='form-group'>
            <input class='form-control' type="text" v-model="contentInfo.quotes" @input="createButton('quotes')">
            <button class='btn btn-success' v-if="hiddenButtons.quotes" 
            @click="saveQuotes()">
                Зберегти
            </button>
        </div>
        <div class='form-group'>
            
            <textarea name="fullDescription" v-model="contentInfo.fullDescription"
            @input="createButton('fullDesc')"></textarea>

            <button class='btn btn-success'
            @click="saveFullDescription()">
                Зберегти опис сайту
            </button>
        </div>

    </fieldset>
</div>

<!--Vue controller-->
<script>

    let wf = new Vue({
        el: "#__web_info",

        data: {

            websiteInfo : {},

            contentInfo: {},

            hiddenButtons: {
                'title' : false,
                'desc' : false,
                "keys" : false,
                "quotes" : false,
                "fullDesc" : false
            },

            bpt : new String("<?php $ms->get_basepath() ?>/")

        },

        created() {

            this.getWebsiteInfo()

        },

        methods: {

            getWebsiteInfo() {

                this.$http.get(this.bpt + "core/listeners/web_info.php")
                    .then(res => {
                        console.log(res.body)

                        this.websiteInfo = res.body.website
                        this.contentInfo = res.body.content

                        console.log(this.contentInfo)
                    }, err => console.error(err))

            },
            createButton(method) {
                this.hiddenButtons[method] = true;
            },

            saveConfiguration(whatSave) {

                this.$http.post(this.bpt + "core/listeners/web_info/web_change.php",
                    {
                        req: "change_website_info",
                        method: whatSave,
                        newText: this.websiteInfo[whatSave]
                    }, {
                        emulateJSON: true
                    }).then(res => {
                        console.log(res.body)
                    }, err => console.error(err))

            },

            saveFullDescription() {

               this.$http.post(`${this.bpt}core/listeners/web_info/web_change.php`, {
                    req: "change_content_fulldesc",
                    fullDescription: CKEDITOR.instances.fullDescription.getData()
               }, {
                emulateJSON: true
               }).then(res => {
                console.log(res)
               }, err => console.error(err))

            },
            saveQuotes() {

                let req = "change_content_quotes"

            }

           

        }


    })

</script>


<style>
    .__web_info input {
        width: 100%;
        
    }
</style>