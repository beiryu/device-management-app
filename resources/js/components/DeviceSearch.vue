<template>
    <div class="searchbar">
        <form action="">
            <datalist id="devices">
                <option 
                    :value="device.name" v-for="device in devices"
                    :key="device.id">
                </option>
            </datalist>
            <input type="text" placeholder="Search..." name="search" list="devices" 
                v-model="keywords" 
                v-on:input="debounceInput"
            />
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>     
</template>

<script>

import axios from 'axios'
import _, {debounce} from 'lodash';

export default {
    data() {
        return {
            keywords: '',
            devices: [],
        }
    },
    methods: {
        getDevices() {
            axios.get('/api/device/livesearch?search='+this.keywords)
                .then((response) => {
                    this.devices = response.data.data;
                }
            )
        },
        
        debounceInput: _.debounce( function() {
            this.getDevices();
        }, 500)
    },
};
</script>