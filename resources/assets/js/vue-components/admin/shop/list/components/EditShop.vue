<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_shop">
            <div class="panel-body">
                <h3 class="text-center mb-3">Edit <strong>{{ shop.title }}</strong></h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="title"class="form-control-label panel-font-small m-0">
                                Name
                            </label>
                            <input id="title" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   @input="$v.input.title.$touch()"
                                   :class="{'form-control-danger': $v.input.title.$error}"
                                   :placeholder="shop.title" 
                                   v-model="input.title">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="title-required" class="text-danger" 
                                v-if="!$v.input.title.required && $v.input.title.$dirty">
                                    Title is required
                                </span>
                                <span key="title-minimum" class="text-danger" 
                                v-else-if="!$v.input.title.minLength">
                                    Title has a minimum of {{ $v.input.title.$params.minLength.min }} characters
                                </span>
                                <span key="title-maximum" class="text-danger" 
                                v-else-if="!$v.input.title.maxLength">
                                    Title has a maximum of {{ $v.input.title.$params.maxLength.max }} characters
                                </span>
                            </transition>

                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="sub_title"
                                   class="form-control-label panel-font-small m-0">
                                Subname
                            </label>

                            <input id="sub_title" type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :class="{'form-control-danger': $v.input.sub_title.$error}"
                                   @input="$v.input.sub_title.$touch()"
                                   :placeholder="shop.sub_title"
                                   v-model="input.sub_title">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="subname-required" class="text-danger" v-if="!$v.input.sub_title.required && $v.input.sub_title.$dirty">
                                    Item Subname is required
                                </span>
                                <span key="subname-minimum" class="text-danger" v-else-if="!$v.input.sub_title.minLength">
                                    Item Subname has a minimum of {{ $v.input.sub_title.$params.minLength.min }} characters
                                </span>
                                <span key="subname-maximum" class="text-danger" v-else-if="!$v.input.sub_title.maxLength">
                                    Item Subname has a maximum of {{ $v.input.sub_title.$params.maxLength.max }} characters
                                </span>
                            </transition>

                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="price"
                                   class="form-control-label panel-font-small m-0">
                                Price
                            </label>
                            
                            <input id="price" type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :class="{'form-control-danger': $v.input.price.$error}"
                                   @input="$v.input.price.$touch()"
                                   :placeholder="shop.price"
                                   v-model="input.price">
                        <!--======================================================================================
                            V A L I D A T I O N     E R R O R   M E S S A G E S
                            ======================================================================================-->
                        <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                            <span key="price-required" class="text-danger" v-if="!$v.input.price.required && $v.input.price.$dirty">
                                Price is required
                            </span>
                        </transition>
                        </div>

                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="stock"
                                   class="form-control-label panel-font-small m-0">
                                Stock
                            </label>

                            <input id="stock" type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :class="{'form-control-danger': $v.input.stock.$error}"
                                   @input="$v.input.stock.$touch()"
                                   :placeholder="shop.stock"
                                   v-model="input.stock">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="stock-required" class="text-danger" v-if="!$v.input.stock.required && $v.input.stock.$dirty">
                                    Stock is required
                                </span>
                            </transition>

                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="category"class="form-control-label panel-font-small m-0">
                                Category
                            </label>

                            <select class="form-control" id="category" 
                                    :class="{'form-control-danger': $v.category_id.$error}"
                                    @input="$v.category_id.$touch()" v-model="category_id"> 
                                <option v-for="category in categories" 
                                        :value=category.id> {{ category.title }}
                                </option>
                            </select>

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R    M E S S A G E S
                                ======================================================================================-->
                                <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                    <span key="category-required" class="text-danger" v-if="!$v.category_id.required && $v.category_id.$dirty">
                                        Category is required
                                    </span>
                                </transition>
                        </div>

                        <transition enterActiveClass="fade-in-down"leaveActiveClass="fade-out-up"mode="out-in">
                            <div class="col-sm-6 col-xs-12 text-center" v-if="isMoreOne">
                                <label for="subcategory"class="form-control-label panel-font-small m-0">
                                    Subcategory
                                </label>

                                <select class="form-control" id="subcategory" v-model.lazy="input.sub_category_id">
                                    <option value="" disabled>Choose Subcategory</option>
                                    <option v-for="subcategory in subcat" 
                                            :value=subcategory.id> {{ subcategory.title }} 
                                    </option>
                                </select>
                            </div>
                        </transition>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="description"
                                   class="form-control-label panel-font-small m-0">
                                Desciption
                            </label>

                            <textarea class="form-control form-control-sm normal-placeholder" 
                                      id="description"rows="10"
                                      @input="$v.input.description.$touch()"
                                      :placeholder="shop.description"
                                      v-model="input.description">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="link"
                                   class="form-control-label panel-font-small m-0">
                                Link online shop
                            </label>
                            
                            <input id="link"type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :class="{'form-control-danger': $v.input.store_link.$error}"
                                   :placeholder="shop.store_link"
                                   v-model="input.store_link">

                            <!--======================================================================================
                                V A L I D A T I O N     E R R O R   M E S S A G E S
                                ======================================================================================-->
                            <transition enterActiveClass="fade-in" leaveActiveClass="fade-out" mode="out-in">
                                <span key="link-minimum" class="text-danger" v-if="!$v.input.store_link.minLength">
                                    Link has minimum of {{ $v.input.store_link.$params.minLength.min }} characters
                                </span>
                            </transition>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <div class="full-width">
                                <label for="status"
                                class="form-control-label panel-font-small m-0">
                                    Status Item
                                </label>
                            </div>

                            <input type="radio" :name=shop.id  value=1 v-model="input.is_displayed"> Show
                            <input type="radio" :name=shop.id  value=0 v-model="input.is_displayed" class="ml-2"> Hide
                        </div>
                    </div>
                    
                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-secondary btn-sm"@click="closeEditForm">
                            Cancel
                        </button>

                        <button @click="editShop"class="btn btn-success btn-sm ml-2" :disabled="isRequesting">
                            <template v-if="isRequesting">Saving..</template>
                            <template v-else>Save</template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import {required, minLength, maxLength} from 'vuelidate/lib/validators';
    import {mapGetters} from 'vuex';
    export default{

        props: {
            shop: {
                type: [Object],
                default() {
                    return {}
                }
            }
        },

        data(){
            return {
                isRequesting: false,
                category_id: this.shop.category_id,
                subcat: '',
                isMoreOne: this.shop.sub_category_id == null ? false : true,
                input:{
                    sub_category_id : this.shop.sub_category_id,
                    title : this.shop.title,
                    sub_title : this.shop.sub_title,
                    stock : this.shop.stock,
                    description : this.shop.description,
                    price : this.shop.price,
                    store_link : this.shop.store_link === null ? '' : this.shop.store_link,
                    is_displayed : this.shop.is_displayed
                }
            }   
        },

        mounted(){
            this.setSubcategory();
        },

        validations: {
            input: {
                title: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(50)
                },
                sub_title:{
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(50)
                },
                store_link: {
                    minLength: minLength(5),
                },
                stock: {
                    required,
                },
                price:{
                    required,
                },
            },
            category_id:{
                    required
            }
        },

        computed: {
            ...mapGetters({
                categories: 'getCategories'
            }),

            shopIsEdited(){
                return this.shop.title !== this.input.title 
                    || this.shop.sub_title !== this.input.sub_title
                    || this.shop.stock !== this.input.stock
                    || this.shop.description !== this.input.description
                    || this.shop.store_link !== this.input.store_link
                    || this.shop.price !== this.input.price
                    || this.shop.category_id !== this.category_id
                    || this.shop.sub_category_id !== this.input.sub_category_id
                    || this.shop.is_displayed !== this.input.is_displayed;
            },

            isFormFilled(){
                return this.input.title != ''
                    && this.input.title.length >= 3
                    && this.input.title.length <= 50
                    && this.input.sub_title != ''
                    && this.input.sub_title.length >= 3
                    && this.input.sub_title.length <= 50
                    && this.input.stock != ''
                    && this.input.price != ''
                    && this.input.is_displayed != ''
                    && (this.input.store_link == '' || (this.input.store_link.length >= 5) )
            },

            is_subCat(){
                if(this.subcat.length >= 1){
                    return this.input.sub_category_id != '';
                }else{
                    return this.input.sub_category_id == '' ||  this.input.sub_category_id == null;
                }
            }
        },

        methods: {

            setSubcategory(){
                for(let a = 0; a < this.categories.length; a++){
                    for(let b = 0; b < this.categories[a].subcategories.length; b++){
                        if(this.categories[a].subcategories[b].id === this.shop.sub_category_id ){
                            this.subcat = this.categories[a].subcategories;
                        }
                    }
                }
            },

            editShop(){

                const self = this;

                if (this.shopIsEdited && this.is_subCat && this.isFormFilled && !this.isRequesting) {

                    this.isRequesting = true;

                    const updatedShop = {
                        id: this.shop.id,
                        title: this.input.title,
                        sub_title: this.input.sub_title,
                        stock: this.input.stock,
                        description: this.input.description,
                        price: this.input.price,
                        store_link: this.input.store_link,
                        is_displayed: this.input.is_displayed,
                        category_id: this.category_id,
                        sub_category_id: this.input.sub_category_id,
                    };

                    this.$store.dispatch('update_shop', updatedShop)

                        .then((updatedShop) => {

                            flash(updatedShop.title + ' is successfully updated', 'success');

                            self.isRequesting = false;

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }else{
                    this.diryAllInputs();
                }
            },

            diryAllInputs(){
                this.$v.input.title.$touch();
                this.$v.input.sub_title.$touch();
                this.$v.input.stock.$touch();
                this.$v.input.price.$touch();
                this.$v.category_id.$touch();
            },

            closeEditForm() {
                this.$emit('editionFormIsClosed', false);
            }
        },

        watch:{
            category_id(){
                this.input.sub_category_id = '';

                let index = _.findIndex(this.categories, ['id', this.category_id]);
                this.subcat = this.categories[index].subcategories;
                this.isMoreOne = this.subcat.length > 0 ? true : false;
            }
        }
    };
</script>

<style type="text/css">
    ::-webkit-input-placeholder,
    :-moz-placeholder, /* Firefox 18- */
    ::-moz-placeholder, /* Firefox 19+ */
    :-ms-input-placeholder {
        text-align: center;
    }

    input {
        text-align: center;
    }

    select {
        text-align: center;
        text-align-last: center;
        /* webkit*/
    }

    option {
        text-align: left;
    }

    .normal-placeholder::-webkit-input-placeholder,
    .normal-placeholder:-moz-placeholder,
    .normal-placeholder::-moz-placeholder,
    .normal-placeholder:-ms-input-placeholder {
        text-align: left !important;
    }
</style>

<style scoped>
    .bg-grey {
        background: #fafafa;
    }

    .panel-font-small {
        font-size: 0.9rem;
    }
</style>