<template>

    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">

        <div class="panel-default panel mt-5" id="edit_shop">
            <div class="panel-body">
                <div class="row pl-0 pr-0 m-0 pt-4 pb-4 bg-grey">


                    <!--=========================================================================================
                        N A M A
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
                                Title
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   v-model="input.title">
                        </div>
                    </div>


                    <!--=========================================================================================
                        L O C A T I O N
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="sub_title"
                                   class="form-control-label panel-font-small m-0">
                                Sub-title
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="sub_title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   v-model="input.sub_title">
                        </div>
                    </div>


                    <!--=========================================================================================
                        S T O C K
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="stock"
                                   class="form-control-label panel-font-small m-0">
                                Stock
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="stock"
                                   type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   v-model="input.stock">
                        </div>
                    </div>


                    <!--=========================================================================================
                        D E S C R I P T I O N
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="description"
                                   class="form-control-label panel-font-small m-0">
                                Description
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <textarea class="form-control form-control-sm" 
                                      id="description" 
                                      v-model="input.description"></textarea>
                        </div>
                    </div>


                    <!--=========================================================================================
                        P R I C E 
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="price"
                                   class="form-control-label panel-font-small m-0">
                                Price
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="price"
                                   type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   v-model="input.price">
                        </div>
                    </div>


                    <!--=========================================================================================
                        S T O R E   L I N K
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="price"
                                   class="form-control-label panel-font-small m-0">
                                Store Link
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <input id="price"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   v-model="input.store_link">
                        </div>
                    </div>


                    <!--=========================================================================================
                        C A T E G O R Y
                        =========================================================================================-->
                    <div class="col-sm-12 row form-group">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="subcategory"
                                   class="form-control-label panel-font-small m-0">
                                Category
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" id="subcategory" v-model="category_id"> 
                                <option v-for="category in categories" 
                                        :value=category.id> {{ category.title }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <!--=========================================================================================
                        S U B    C A T E G O R Y
                        =========================================================================================-->
                    <transition enterActiveClass="fade-in-down"
                                leaveActiveClass="fade-out-up"
                                mode="out-in">
                    <div class="col-sm-12 row form-group" v-if="isMoreOne">
                        <div class="col-sm-3 col-xs-12 d-flex align-items-center justify-content-end">
                            <label for="subcategory"
                                   class="form-control-label panel-font-small m-0">
                                Sub Category
                            </label>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" id="subcategory" v-model.lazy="input.sub_category_id">
                                <option value="">Pilih Sub Category</option>
                                <option v-for="subcategory in subcat"
                                        :value=subcategory.id> {{ subcategory.title }}
                                </option>
                            </select>
                        </div>
                    </div>
                    </transition>


                    <!--=========================================================================================
                        A C T I O N   B U T T O N
                        =========================================================================================-->
                    <div class="col-sm-4 offset-3 d-flex justify-content-around mt-3">
                        <div class="col-sm-6">
                            <button type="button" 
                                class="full-width btn btn-secondary btn-block btn-sm"
                                @click="closeEditForm">Batal</button>
                        </div>

                        <div class="col-sm-6">
                            <button @click="editShop"
                                    class="full-width btn btn-success btn-block btn-sm">
                                    Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
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
                    store_link : this.shop.store_link,
                    is_displayed : this.shop.is_displayed
                }
            }   
        },

        mounted(){
            this.setSubcategory();
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

            is_subCat(){
                if(this.subcat.length >= 1){
                    return this.input.sub_category_id != '';
                }else{
                    return this.input.sub_category_id == '';
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

                if (this.shopIsEdited && this.is_subCat) {

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

                            flash('Shop item Berhasil diperbaharui', 'success');

                            self.closeEditForm();
                        })
                        .catch(errors => {
                            self.isRequesting = false;
                        });
                }
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

<style scoped>
    .pl-15-px {
        padding-left: 15px !important;
    }
</style>