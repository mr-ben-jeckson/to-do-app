<template>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        <h2>Task</h2>
        <form @submit.prevent="addProduct" class="mb-3">
            <div class="from-group mb-1">
                <input type="text" class="form-control" placeholder="Title" v-model="product.title" required>
            </div>
            <div class="form-group mb-1">
                <textarea class="form-control" placeholder="Content" v-model="product.content" required></textarea>
            </div>
            <div class="form-group mb-1">
                <select class="form-control" v-model="product.status" required>
                    <option value="" v-if="!product.status" selected>Status</option>
                    <option value="1">Finished</option>
                    <option value="0">To Do</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-xs">Save</button>
            </div>
        </form>
        </div>
        <div class="col-md-6">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a href="#" class="page-link" @click="fetchProducts(pagination.prev_page_url)">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a href="#" class="page-link text-dark"> Page {{ pagination.current_page}} of {{ pagination.last_page}} </a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a href="#" class="page-link" @click="fetchProducts(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="product in products" v-bind:key="product.id" v-if="products">
            <h3>{{product.title}}</h3>
            <p>
                {{product.content}}
            </p>
            <hr>
            <ul class="col-md-12">
            <li @click="deleteProduct(product.id)" class="btn btn-danger btn-sm col-md-2 col-xs-4">Delete</li>
            <li @click="editProduct(product)" class="btn btn-primary btn-sm col-md-2 col-xs-4">Edit</li>
            <li class="btn btn-success btn-sm col-md-2 col-xs-4" v-if="product.status === 1">Finished</li>
            <li class="btn btn-warning btn-sm col-md-2 col-xs-4" v-if="product.status === 0">To Do</li>
            </ul>
        </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                products: [],
                product: {
                    id: '',
                    title: '',
                    content: '',
                    status: ''
                },
                product_id: '',
                pagination: {},
                edit: false,
            };
        },
        created() {
            this.fetchProducts();
        },
        methods: {
                fetchProducts(page_url){
                    let vm = this;
                    page_url = page_url || 'api/products'
                    fetch(page_url)
                        .then(res => res.json())
                        .then(res => {
                            this.products = res.data;
                            vm.makePagination(res.meta, res.links);
                        })
                        .catch(err => console.log(err));
                },
                makePagination(meta, links){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }
                this.pagination = pagination;
            },
                addProduct(){
                if (this.edit === false){
                    //Add
                    fetch('api/product',{
                        method: 'post',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.product.title = '';
                            this.product.content = '';
                            this.product.status = '';
                            this.$toaster.success('Task was successfully added');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));
                }
                else {
                    //Add
                    fetch('api/product',{
                        method: 'put',
                        body: JSON.stringify(this.product),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            this.product.title = '';
                            this.product.content = '';
                            this.product.status = '';
                            this.$toaster.info('Task was successfully updated');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));
                }

            },

            deleteProduct(id){
                if (confirm('Are You Sure?')){
                    fetch('api/product/'+id,{
                        method: 'delete'
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.productRemove = true;
                            this.$toaster.warning('Task was successfully deleted');
                            this.fetchProducts();
                        })
                        .catch(err => console.log(err));
                }
            },

            editProduct(product){
                    this.edit = true;
                    this.product.id = product.id;
                    this.product.product_id = product.id;
                    this.product.title = product.title;
                    this.product.content = product.content;
                    this.product.status = product.status;
            }
        }
    };
</script>