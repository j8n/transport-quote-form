<template>
	<div class="category-btn" :category="categoryKey" v-on:click="emitOpenContainer" ref="theCategoryButton" v-bind:class="[{ categorySelected: isSelected }, {categoryButtonHasItemsSelected: hasItemsSelected}]">
        <i class="category-btn-icon" v-bind:class="icon"></i>
        <h6 class="mt-2 category-btn-title">{{ categoryName }}</h6>
    </div>
</template>

<script>
    export default {
	    props: {
			icon: String,
			categoryKey: String,
			categoryName: String,
		},

        mounted() {
            //console.log('Category button component mounted.')
        },

        data: function(){
        	return {
        		isSelected: false,
        		hasItemsSelected: false,
        	}
        },

        methods: {
        	activateCategory: function (categoryKey) {
				alert(categoryKey);
				alert(this.categoryKey);
			},
			
			onEnlargeText: function (enlargeAmount) {
				alert(this.categoryKey);
			},

			emitOpenContainer(){
				console.log('trying to emit onEmitOpenContainer');
				this.$emit('onEmitOpenContainer', this.categoryKey);
				
			}
        },
    }
</script>