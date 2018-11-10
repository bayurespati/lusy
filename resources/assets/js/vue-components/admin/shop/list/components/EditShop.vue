<template>
    <transition enterActiveClass="fade-in-down"
                leaveActiveClass="fade-out-up"
                mode="out-in">
        <div class="panel-default panel mt-3 pt-4 bg-grey" id="edit_shop">
            <div class="panel-body">
                <h3 class="text-center font-weight-bold mb-3">Edit {{ shop.title }}</h3>

                <div class="row pl-0 pr-0 m-0 pt-4 pb-4">
                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="title"
                                   class="form-control-label panel-font-small m-0">
                                Nama
                            </label>
                            <input id="title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :placeholder="shop.title" 
                                   v-model="input.title">
                        </div>
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="sub_title"
                                   class="form-control-label panel-font-small m-0">
                                Sub Nama
                            </label>

                            <input id="sub_title"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :placeholder="shop.sub_title"
                                   v-model="input.sub_title">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="price"
                                   class="form-control-label panel-font-small m-0">
                                Harga
                            </label>
                            
                            <input id="price"
                                   type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :placeholder="shop.price"
                                   v-model="input.price">
                        </div>
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="stock"
                                   class="form-control-label panel-font-small m-0">
                                Stok
                            </label>

                            <input id="stock"
                                   type="number"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :placeholder="shop.stock"
                                   v-model="input.stock">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-6 col-xs-12 text-center">
                            <label for="category"
                                   class="form-control-label panel-font-small m-0">
                                Kategori
                            </label>

                            <select class="form-control" id="category" v-model="category_id"> 
                                <option v-for="category in categories" 
                                        :value=category.id> {{ category.title }}
                                </option>
                            </select>
                        </div>

                        <transition enterActiveClass="fade-in-down"
                        leaveActiveClass="fade-out-up"
                        mode="out-in">
                            <div class="col-sm-6 col-xs-12 text-center" v-if="isMoreOne">
                                <label for="subcategory"
                                class="form-control-label panel-font-small m-0">
                                    Subkategori
                                </label>

                                <select class="form-control" id="subcategory" v-model.lazy="input.sub_category_id">
                                    <option value="">Pilih Subkategori</option>
                                    <option v-for="subcategory in subcat" :value=subcategory.id> {{ subcategory.title }} </option>
                                </select>
                            </div>
                        </transition>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="description"
                                   class="form-control-label panel-font-small m-0">
                                Deskripsi Item
                            </label>

                            <textarea class="form-control form-control-sm normal-placeholder" 
                                      id="description"
                                      rows="10"
                                      :placeholder="shop.description"
                                      v-model="input.description">
                            </textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex form-group">
                        <div class="col-sm-12 text-center">
                            <label for="link"
                                   class="form-control-label panel-font-small m-0">
                                Link Toko Online
                            </label>
                            
                            <input id="link"
                                   type="text"
                                   class="form-control form-control-sm"
                                   @keyup.enter="editShop"
                                   :placeholder="shop.store_link"
                                   v-model="input.store_link">
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

                            <input type="radio" :name=shop.id  value=1 v-model="input.is_displayed"> Tampilkan
                            <input type="radio" :name=shop.id  value=0 v-model="input.is_displayed" class="ml-2"> Sembunyikan
                        </div>
                    </div>
                    
                    <div class="col-sm-12 d-flex justify-content-center mt-2">
                        <button type="button" 
                        class="btn btn-secondary btn-sm"
                        @click="closeEditForm">
                            Batal
                        </button>

                        <button @click="editShop"
                        class="btn btn-success btn-sm ml-2">
                            Simpan
                        </button>
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