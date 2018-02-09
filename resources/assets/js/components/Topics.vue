<template>
    <div>
        <v-select
        multiple
        :debounce="250"
    	:on-search="getOptions"
    	placeholder="选择适合的Topic"
    	label="name"
        :on-change="consoleCallback"
        :options="options"
        v-model="selected"
        ></v-select>
        <input type="hidden" name="topics[]" v-for="item in value" v-model="item.id">
    </div>
</template>

<script>
    import vSelect from "vue-select";
    export default {
        props: ['select'],
        components: {vSelect},
        data () {
            return {
                value: [],
                options: [],
                selected: this.select ? JSON.parse(this.select) : [],
            }
        },
        methods: {
            getOptions (search, loading) {
                axios.get('/api/topics', {'params': {'query': search}}).then(response => {
                    this.options = response.data.topics;
                    console.log(this.options);
                });
            },
            consoleCallback(val) {
                this.value = val;
                const value = this.value.map(item => {
                    return {
                        id: item.id
                    };
                });
             },

        }
    }
</script>
