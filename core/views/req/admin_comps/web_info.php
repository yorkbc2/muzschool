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
        <div>
            <input type="text" v-model="websiteInfo.title" @input="createButton('title')">
            <button class='btn btn-success' v-if="hiddenButtons.title" @click="saveConfiguration('title')">Зберегти</button>
        </div>
        <div>
            <textarea v-model="websiteInfo.description" @input="createButton('desc')"></textarea>
            <button class='btn btn-success' v-if="hiddenButtons.desc" @click="saveConfiguration('description')">Зберегти</button>
        </div>
        <div>
            <input type="text" v-model="websiteInfo.keywords" @input="createButton('keys')">
            <button class='btn btn-success' v-if="hiddenButtons.keys" @click="saveConfiguration('keywords')">Зберегти</button>
        </div>
    </fieldset>
</div>

<!--Vue controller-->
<script>

    let wf = new Vue({
        el: "#__web_info",

        data: {

            websiteInfo : {},

            hiddenButtons: {
                'title' : false,
                'desc' : false,
                "keys" : false
            },

            bpt : new String(<?php $ms->get_basepath() ?>/)

        },

        created() {

            this.getWebsiteInfo()

        },

        methods: {

            getWebsiteInfo() {

                this.$http.get(this.bpt + "core/listeners/web_info.php")
                    .then(res => {
                        this.websiteInfo = res.body
                    }, err => console.error(err))

            },
            createButton(method) {
                this.hiddenButtons[method] = true;
            },

            saveConfiguration(whatSave) {

                this.$http.post(this.bpt + "core/listeners/web_info/web_change.php",
                    {
                        method: whatSave,
                        newText: this.websiteInfo[whatSave]
                    }, {
                        emulateJSON: true
                    }).then(res => {
                        console.log(res.body)
                    }, err => console.error(err))

            }

           

        }


    })

</script>


<style>
    .__web_info input {
        width: 100%;
        
    }
</style>