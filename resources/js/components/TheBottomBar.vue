<template>
	
</template>

<script>
    export default {
        mounted() {
            // console.log('The header component mounted.')
        },

        data: function () {
			return {
				isOpened: false,
				objectName: null,
				objectCategory: null,
			}
		},

		methods: {
			confirm: function(){
				// close the container
				this.isOpened = false;

				//lengthInput
				//widthInput
				//heightInput
				//weightInput

				console.log(this.$refs.lengthInput.value);

				var data = {
					lenght: this.$refs.lengthInput.value,
					width: this.$refs.widthInput.value,
					height: this.$refs.heightInput.value,
					weight: this.$refs.weightInput.value,
				}

				this.$parent.addObject(this.objectName, this.objectCategory, data);
			},

			close: function(){
				this.isOpened = false;
			}
		}

    }
</script>