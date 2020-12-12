<template>
    <div id="app">
        <the-navbar ref="theNavbar"></the-navbar>

        <!-- panels start -->
        <section id="panels" ref="panelsContainer">

            <!-- object panel start -->
            <div id="objects-panel" class="panel card" ref="objectsPanel">
                <!-- panels row start -->
                <div class="row">
                    <!-- categories col start -->
                    <div class="col-12 categories-container" ref="categoriesContainer">
                        <category-button
                            v-for="category, index in categories" 
                            :key="index" 
                            :icon="category.icon" 
                            :categoryName="category.name" 
                            :categoryKey="index"
                            v-on:onEmitOpenContainer="openObjectsTab"
                            ref='categoryButtons'
                        >

                        </category-button>
                    </div>
                    <!-- categories col end -->
                    <!-- object col start -->
                    <div class="col-12" ref="objectContainersContainer">
                        <object-container
                            v-for="category, index in categories" 
                            :key="index" 
                            :isOpened="false" 
                            :categoryKey="index"
                            :categoryName="category.name"
                            ref='objectContainers'
                            :categoryObjectKeys="category.objects"
                            :objects="objects"

                        >

                        </object-container>
                    </div>
                    <!-- object col end -->
                </div>
                <!-- panels row end -->
            </div>
            <!-- object panel end -->

            <!-- addresses panel start -->
            <div id="addresses-panel" class="panel card" ref="addressesPanel">
                <!-- addresses row start -->
                <div class="row p-3">
                    <div class="col-12 col-md-12 col-lg-6">
                        <address-input :title="'Address From'" v-bind:address="addressFrom" ref="addressFromInput"></address-input>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <address-input :title="'Address To'" v-bind:address="addressTo" ref="addressToInput"></address-input>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <address-input
                            :title="'intermediate Stop'"
                            v-for="extraAddr, index in extraAddresses"
                            :key="index"
                            v-bind:address="extraAddr"
                        >
                        </address-input>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-outline-secondary" @click="addExtraAddress">Add intermediate stop</button>
                    </div>
                </div>
                <!-- addresses row end -->
            </div>
            <!-- addresses panel end -->

            <!-- contact panel start -->
            <div id="contact-panel" class="panel card p-2" ref="contactPanel">
                <div class="row p-1 justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4">
                        <input type="" class="form-control" name="" ref="contactName" placeholder="Full name (Needed)">
                    </div>
                </div>
                <div class="row p-1 justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4">
                        <input type="" class="form-control" name="" ref="contactPhone" placeholder="Contact phone (Needed)">
                    </div>
                </div>
                <div class="row p-1 justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4">
                        <input type="email" class="form-control" name="" ref="contactEmail" placeholder="Email address (Needed)">
                    </div>
                </div>
                <div class="row p-1 justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4">
                        <input type="" class="form-control" name="" ref="contactDate" placeholder="Choose date to move in">
                    </div>
                </div>
                <div class="row p-1 justify-content-center">
                    <div class="col-12 col-md-12 col-lg-12 text-center">
                        <button  class="btn btn-success" ref="submitButton" name="" @click="submitAll">Send</button>
                    </div>
                </div>
            </div>
            <!-- contact panel end -->

        </section>
        <!-- panels end -->

        <!-- header start -->
        <section class="card mt-2">
            <div style="display: flex;" class="p-2 text-left">
                <div v-if="currentPanel == 'objects'">
                    <button class="btn btn-success" @click="openAddressesPanel">Add Addresses <i class="fas fa-arrow-right"></i></button>
                </div>
                <div v-else-if="currentPanel == 'addresses'">
                    <button class="btn btn-secondary m-2" @click="openObjectsPanel"><i class="fas fa-arrow-left"> Back</i></button>
                    <button class="btn btn-success" @click="openContactPanel">Contact Informantion <i class="fas fa-arrow-right"></i></button>
                </div>
                <div v-else-if="currentPanel == 'contact'">
                    <button class="btn btn-secondary" @click="openAddressesPanel"><i class="fas fa-arrow-left"> Back</i></button>
                </div>
            </div>
        </section>
        <!-- header end -->

        <!-- <div class="fixed-bottom m-3">
            <button title="Object list" class="btn btn-success" ><i style="font-size: 20px;" class="fas fa-list"></i> </button>
        </div>
        -->
    </div>
</template>

<script>
    import axios from 'axios'
    import TheNavbar from './TheNavbar.vue';
    import CategoryButton from './CategoryButton.vue';
    import ObjectButton from './ObjectButton.vue';
    import ObjectContainer from './ObjectContainer.vue';
    import AddressInput from './AddressInput.vue';
    import TheBottomBar from './TheBottomBar.vue';

    export default {

        /**********************************************
            Data
        **********************************************/
        data() {
            return {
                categoryKeys: CATEGORY_KEYS,
                categories: CATEGORIES,
                objects: OBJECTS,
                categoryButtons: [],
                objectContainers: [],
                userObjects: [],
                currentPanel: '',
                extraAddresses: [],
                addressFrom: {
                    isExtraAddress: false,
                    street: null,
                    number: null,
                    city: null,
                    type: 'Apartment',
                    floor: 'Ground Floor',
                },
                addressTo: {
                    isExtraAddress: false,
                    street: null,
                    number: null,
                    city: null,
                    type: 'Apartment',
                    floor: 'Ground Floor',
                },
                company: {
                    name: 'The_Company_Name',
                    url: 'The_Company_Url',
                    imageSRC: 'The_Company_Image_src',
                },
                enableValidations: true,
            }
        },

        /**********************************************
            Components
        **********************************************/
        components: {
            TheNavbar,
            CategoryButton,
            ObjectButton,
            ObjectContainer,
            AddressInput,
            TheBottomBar
        },

        /**********************************************
            Created
        **********************************************/
        created: function () {
            //console.log(this.categoryKeys);
            //console.log(this.categories);
            //console.log(this.objects);

        },

        /**********************************************
            mounted
        **********************************************/
        mounted: function(){
            
            this.theNavbar = this.$refs.theNavbar;
            this.panelsContainer = this.$refs.panelsContainer;
            this.objectsPanel = this.$refs.objectsPanel;
            this.addressesPanel = this.$refs.addressesPanel;
            this.contactPanel = this.$refs.contactPanel;
            this.categoryButtons = this.$refs.categoryButtons;
            this.objectContainers = this.$refs.objectContainers;

            this.contactName = this.$refs.contactName;
            this.contactPhone = this.$refs.contactPhone;
            this.contactEmail = this.$refs.contactEmail;
            this.contactDate = this.$refs.contactDate;

            this.submitButton = this.$refs.submitButton;
            
            //console.log(this.categoryButtons);
            //console.log(this.objectContainers);

            this.openObjectsPanel();

            flatpickr(this.$refs.contactDate, {
                dateFormat: 'd-m-Y',
                disable: [
                    function(selectedDate){
                        var today = new Date();
                        today.setHours(0,0,0,0);
                        return (selectedDate <= today);
                    }
                ]
            });
            //showLoading();
            //Success('asd');
        },

        /**********************************************
            Methods
        **********************************************/
        methods: {

            /**********************************************
               Close all panels
            **********************************************/
            closeAllPanels: function(){
                this.objectsPanel.style.display = 'none';
                this.addressesPanel.style.display = 'none';
                this.contactPanel.style.display = 'none';
            },

            /**********************************************
                Open objects panel
            **********************************************/
            openObjectsPanel: function(panelName){
                this.closeAllPanels();
                this.objectsPanel.style.display = 'block';
                this.setMainTitle('Choose the items you want to transport');
                this.openFirstObjectsTab();
                this.currentPanel = 'objects';
            },

            /**********************************************
                Open addresses panel
            **********************************************/
            openAddressesPanel: function(){
                if(!this.validateObjectsPanel()){
                    Alert('Choose items');
                    return;
                }
                this.closeAllPanels();
                this.addressesPanel.style.display = 'block';
                this.setMainTitle('Insert addresses');
                this.currentPanel = 'addresses';
            },

            /**********************************************
                Open contact panel
            **********************************************/
            openContactPanel: function(){
                if(!this.validateAddressesPanel()){
                    Alert('Insert addresses data');
                    return;
                }
                this.closeAllPanels();
                this.contactPanel.style.display = 'block';
                this.setMainTitle('Insert contact info');
                this.currentPanel = 'contact';
            },

            /**********************************************
                Set main title
            **********************************************/
            setMainTitle: function(title){
                this.theNavbar.title = title;
            },
            
            /**********************************************
                Close all object containers
            **********************************************/
            closeAllObjectContainers: function(){
                this.objectContainers.forEach(function(con){
                    con.isOpened = false;
                    //console.log('closed');
                });

                for(var i=0; i<this.categoryButtons.length; i++){
                    this.categoryButtons[i].isSelected = false;
                }
            },

            /**********************************************
                Open objects tab by category key
            **********************************************/
            openObjectsTab: function(categoryKey){
                this.closeAllObjectContainers();
                this.objectContainers.forEach(function(con){
                    if(con.categoryKey == categoryKey){
                        con.isOpened = true;
                    }
                    //console.log('closed');
                });

                var categoryButton = this.findCategoryButtonByCategoryKey(categoryKey);
                categoryButton.isSelected = true;
            },

            /**********************************************
                Open first tab (saloni)
            **********************************************/
            openFirstObjectsTab: function(){
                this.openObjectsTab('saloni');
                //this.objectContainers[0].isOpened = true;
            },

            /**********************************************
                Add a user object
            **********************************************/
            addAnObjectWithAClassId: function(objectClassId, name, category, categoryName){
                if(this.objectClassIdAlreadyInUserObjects(objectClassId)){
                    var obj = this.getUserObjectByObjectClassId(objectClassId);
                    if(obj == null){
                        throw Error('Null object');
                    }
                    obj.quantity +=1;
                }else{
                    this.userObjects.push({
                        objectClassId: objectClassId,
                        name: name,
                        category: category,
                        categoryName, categoryName,
                        quantity: 1
                    });
                }

                //console.log(this.userObjects);
                notify('Item added');

                var categoryButton = this.findCategoryButtonByCategoryKey(category);

                //console.log(categoryButton);
                this.showCategoriesSelected();
            },

            /***************************************
                Remove a user object
            ***************************************/
            removeAnObjectByClassId: function(objectClassId){
                var obj = this.getUserObjectByObjectClassId(objectClassId);
                obj.quantity -= 1;
                if(obj.quantity <= 0){
                    this.userObjects.splice(this.userObjects.indexOf(obj), 1);
                }
                //console.log(this.userObjects);
                notify('Item removed');
                this.showCategoriesSelected();
            },

            /**********************************************
                check if object class id exist in user objects
            **********************************************/
            objectClassIdAlreadyInUserObjects: function(objectClassId){
                for(var i=0; i<this.userObjects.length; i++){
                    if(this.userObjects[i].objectClassId == objectClassId){
                        return true;
                    }
                }
                return false;
            },

            /**********************************************
                get user object by class id
            **********************************************/
            getUserObjectByObjectClassId: function(objectClassId){
                for(var i=0; i<this.userObjects.length; i++){
                    if(this.userObjects[i].objectClassId == objectClassId){
                        return this.userObjects[i];
                    }
                }
                return null;
            },

            /**********************************************
                Add extra address
            **********************************************/
            addExtraAddress: function(){
                this.extraAddresses.push({
                    isExtraAddress: true,
                    street: null,
                    number: null,
                    city: null,
                    type: 'Apartment',
                    floor: 'Ground Floor',
                });

                //console.log(this.extraAddresses);
            },

            /**********************************************
                Remove extra address
            **********************************************/
            removeExtraAddress: function(index){
                this.extraAddresses.splice(index, 1);
            },

            /**********************************************
                find category button by key
            **********************************************/

            findCategoryButtonByCategoryKey: function(categoryKey){
                for(var i=0; i<this.categoryButtons.length; i++){
                    if(this.categoryButtons[i].categoryKey == categoryKey){
                        return this.categoryButtons[i];
                    }
                }
            },

            /**********************************************
                reset category buttons item selected
            **********************************************/
            resetCategoryButtonsItemsSelected: function(){
                for(var i=0; i<this.categoryButtons.length; i++){
                    this.categoryButtons[i].hasItemsSelected = false;
                }
            },

            /**********************************************
                Show categories selected
            **********************************************/
            showCategoriesSelected: function(){
                this.resetCategoryButtonsItemsSelected();

                for(var i=0; i<this.userObjects.length; i++){
                    var obj = this.userObjects[i];

                    var categoryButton = this.findCategoryButtonByCategoryKey(obj.category);
                    categoryButton.hasItemsSelected = true;
                }
            },

            /**********************************************
                Panel validations
            **********************************************/
            validateObjectsPanel: function(){
                if(!this.enableValidations){
                    return true;
                }
                if(this.userObjects.length <= 0){
                    return false;
                }
                return true;
            },

            validateAddressesPanel: function(){
                if(!this.enableValidations){
                    return true;
                }

                if(!this.$refs.addressFromInput.validate()){
                    return;
                }

                if(!this.$refs.addressToInput.validate()){
                    return;
                }

                for(var i=0; i<this.extraAddresses.length; i++){
                    if(!this.validateAddress(this.extraAddresses[i])){
                        return;
                    }
                }
                return true;
            },

            validateContactPanel: function(){
                if(!this.enableValidations){
                    return true;
                }

                if(this.contactName.value && this.contactPhone.value && this.validateEmail(this.contactEmail.value)){
                    return true;
                }

                return false;
            },

            validateAddress: function(addressObject){
                if (addressObject.street && addressObject.number && addressObject.city && addressObject.type && addressObject.floor) {
                    return true;
                }
                return false;
            },

            validateEmail: function(email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
            },

            /**********************************************
                Submit all
            **********************************************/
            submitAll: function(){
                //if(!this.validateContactPanel()){
                //    Alert('Εισάγετε προσωπικές πληροφορίες');
                //    return;
                //}
                showLoading();

                var data = {
                    userObjects: this.userObjects,
                    addressFrom: this.addressFrom,
                    addressTo: this.addressTo,
                    extraAddresses: this.extraAddresses,
                    contactName: this.contactName.value,
                    contactPhone: this.contactPhone.value,
                    contactEmail: this.contactEmail.value,
                    contactDate: this.contactDate.value,
                }

                console.log('js data: ', data);
                
                // fd
                var formData = new FormData();

                // append customer info
                formData.append('contactInfo[name]', data.contactName);
                formData.append('contactInfo[phone]', data.contactPhone);
                formData.append('contactInfo[email]', data.contactEmail);
                formData.append('contactInfo[date]', data.contactDate);
                
                // append address from
                formData.append('addressFrom[street]', data.addressFrom.street);
                formData.append('addressFrom[number]', data.addressFrom.number);
                formData.append('addressFrom[city]', data.addressFrom.city);
                formData.append('addressFrom[type]', data.addressFrom.type);
                formData.append('addressFrom[floor]', data.addressFrom.floor);

                // append address to
                formData.append('addressTo[street]', data.addressTo.street);
                formData.append('addressTo[number]', data.addressTo.number);
                formData.append('addressTo[city]', data.addressTo.city);
                formData.append('addressTo[type]', data.addressTo.type);
                formData.append('addressTo[floor]', data.addressTo.floor);

                // append extra addresses
                for(var i=0; i<data.extraAddresses.length; i++){
                    formData.append('extraAddresses['+i+'][street]', data.extraAddresses[i].street);
                    formData.append('extraAddresses['+i+'][number]', data.extraAddresses[i].number);
                    formData.append('extraAddresses['+i+'][city]', data.extraAddresses[i].city);
                    formData.append('extraAddresses['+i+'][type]', data.extraAddresses[i].type);
                    formData.append('extraAddresses['+i+'][floor]', data.extraAddresses[i].floor);
                }

                // append user objects
                for(var j=0; j<data.userObjects.length; j++){
                    //formData.append('userObjects['+j+'][objectClassId]', data.userObjects[j].objectClassId);
                    formData.append('userObjects['+j+'][name]', data.userObjects[j].name);
                    //formData.append('userObjects['+j+'][category]', data.userObjects[j].category);
                    formData.append('userObjects['+j+'][categoryName]', data.userObjects[j].categoryName);
                    formData.append('userObjects['+j+'][quantity]', data.userObjects[j].quantity);
                }

                // make the post
                axios({
                    url: './submit',
                    data: formData,
                    headers: {'Content-Type': 'multipart/form-data'},
                    method: "POST",
                })
                .then(function (res) {
                    if(res.data.success){
                        hideLoading();
                        Success('Data have been submited. We will contact you shortly', function(){
                            window.location.reload(true);
                            console.log('res.data: ', res.data);
                        });
                    }else{
                        if(res && res.data && res.data.errorMessage){
                            Error(res.data.errorMessage);
                            hideLoading();
                        }
                    }
                })
                .catch(function (error) {
                    if(error.response && error.response.status){
                        if(error.response.status == 422){
                            if(error.response.data && error.response.data.errors){
                                var er = error.response.data.errors[Object.keys(error.response.data.errors)[0]][0];
                                console.log(er);
                                Alert(er);
                            }else{
                                Error(error.response.statusText);
                            }
                        }else{
                            Error(error.response.statusText);
                        }
                        
                    }else{
                        Error("Something went wrong!");
                    }
                    
                    hideLoading();
                });
            }
        },
    }

</script>
