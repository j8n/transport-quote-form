<template>
	<div class="col-12 object-btn" ref="theObjectButton" v-bind:class="{ objectBtnSelected: isSelected }">
        <div class="card-body">
            <h5 class="object-btn-title">{{theObject.name}}</h5>
            <div class="">
                <span class="object-btn-quantity" style="">{{ quantity }}</span>
                <button v-on:click="add" class="btn btn-success float-right" style="position: absolute;right: 55px; top: 15px;"><i class="fas fa-plus"></i></button>
                <button v-on:click="remove" class="btn btn-danger float-right" style="position: absolute;right: 15px; top: 15px;"><i class="fas fa-minus"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Object button component mounted.')
        },
        
        props: {
            theObject: Object,
            categoryKey: String,
            categoryName: String,
            objectKey: String,
        },

        data: function(){
            return {
                quantity: 0,
                isSelected: false,
            }
        },

        computed: {
            objectClassId: function(){
                return this.categoryKey + "_" + this.objectKey;
            }
        },

        methods: {
            add: function(){
                // this.$parent.openOptionsContainer(this.theObject.name, this.categoryKey);
                this.$parent.addAnObjectWithAClassId(this.objectClassId, this.theObject.name, this.categoryKey, this.categoryName);
                this.quantity += 1;
                //Alert(this.quantity);
                this.setColorByQuantity();
            },

            remove: function(){
                if(this.quantity <= 0){
                    return;
                }
                this.$parent.removeAnObjectByClassId(this.objectClassId);
                this.quantity -= 1;
                this.setColorByQuantity();
            },

            setColorByQuantity: function(){
                if(this.quantity > 0){
                    this.isSelected = true;
                    //this.$refs.theObjectButton.style.backgroundColor = '#d0d0d0';
                }else{
                    this.isSelected = false
                }
            },

        },
    }
</script>
