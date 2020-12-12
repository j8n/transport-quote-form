<template>
	<div>
        <h5>{{ title }}</h5>
        <div style="position: absolute; right: 45px; top: 10px;" v-if="address.isExtraAddress">
            <i class="fas fa-times" @click=remove style="cursor: pointer;"></i>
        </div>
        

       	<div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-9 mb-2">
                    <input class="form-control" type="" name="" placeholder="Address" v-model="address.street">
                </div>
                <div class="col-12 col-md-12 col-lg-3 mb-2">
                    <input class="form-control" type="" name="" placeholder="Number" v-model="address.number">
                </div> 
            </div>
            <div class="row">
                <div class="col-12 col-md-12 mb-3">
                    <input class="form-control" type="" name="" placeholder="City" v-model="address.city">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 mb-3">
                    <select class="form-control" required="" v-model="address.type">
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <select class="form-control" required="" v-model="address.floor">
                        <option value="Basement">Basement</option>
                        <option value="Ground Floor">Ground Floor</option>
                        <option value="1st Floor">1st Floor</option>
                        <option value="2nd Floor">2nd Floor</option>
                        <option value="3rd Floor">3rd Floor</option>
                        <option value="4th Floor">4th Floor</option>
                        <option value="5th Floor">5th Floor</option>
                        <option value="6th Floor">6th Floor</option>
                        <option value="7th Floor">7th Floor</option>
                        <option value="8th Floor">8th Floor</option>
                        <option value="9th Floor">9th Floor</option>
                    </select>
                </div>
            </div>
       	</div>
    </div>
</template>

<script>
    export default {
	    props: {
            title: String,
            address: Object,
		},

        mounted() {
            //console.log('Category button component mounted.')
            //console.log(this.address.isExtraAddress);
        },

        data: function(){
        	return {
                //address: null,
        		//street: null,
                //number: null,
                //city: null,
                //type: 'apartment',
                //floor: 'floor',
                //isExtraAddress: false,
        	}
        },

        methods: {
        	remove: function(){
                //Alert('removing');
                this.$parent.removeExtraAddress(this.key);
            },

            validate: function(){
                if (this.address.street && this.address.number && this.address.city && this.address.type && this.address.floor) {
                    return true;
                }
                return false;
            },
        },
    }
</script>