<template>
	<div class="container-fluid object-container" :category="categoryKey" v-show="isOpened">
        <div class="row justify-content-center">
        	<object-button
                v-for="categoryObjectKey, index in categoryObjectKeys"
                :key="index" 
                v-bind:theObject="objects[categoryObjectKey]"
                :categoryKey="categoryKey"
                :categoryName="categoryName"
                :objectKey="categoryObjectKey"
            >
            </object-button>
        </div>
    </div>
</template>

<script>

	import ObjectButton from './ObjectButton.vue';

    export default {
    	props: {
			categoryKey: String,
            categoryName: String,
            categoryObjectKeys: Array,
            objects: Object
		},

		computed: {
			
		},

        mounted() {
            
        },

        created: function(){
        	
        },

        data: function () {
			return {
				isOpened: false,
			}
		},

        methods: {
            
            //openOptionsContainer: function(name, category){
            //    this.$parent.openOptionsContainer(name, category);
            //},

            addAnObjectWithAClassId: function(objectClassId, name, category, categoryName){
                this.$parent.addAnObjectWithAClassId(objectClassId, name, category, categoryName);
            },

            removeAnObjectByClassId: function(objectClassId){
                this.$parent.removeAnObjectByClassId(objectClassId);
            },

        },

        components: {
			ObjectButton
        }

    }

</script>
