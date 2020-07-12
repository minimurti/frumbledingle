<template>
    <div>
	    <h5>Items</h5>
	    <hr>
        <form @submit.prevent="createItem">
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newItemName" type="text" class="form-control" placeholder="Item Name" required/>

	            <div class="input-group-prepend">
		            <span class="input-group-text">Categories</span>
	            </div>
	            <select class="form-control" v-model="newItemCategory" required>
		            <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
			            {{ category.name}}
		            </option>
	            </select>

	            <div class="input-group-prepend">
		            <span class="input-group-text">Location</span>
	            </div>
	            <select class="form-control" v-model="newItemLocation" required>
		            <option v-for="local in locations" v-bind:key="local.id" v-bind:value="local.id">
			            {{ local.name}}
		            </option>
	            </select>

	            <div class="input-group-prepend">
		            <span class="input-group-text">Price</span>
	            </div>
	            <input v-model="newItemPrice" type="number" class="form-control" placeholder="0.00" required/>

	            <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.category? row.category.name:null }}</td>
                    <td>{{ row.location? row.location.name:null }}</td>
                    <td>$ {{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: [],
	        categories: [],
	        locations: [],
	        newItemName: '',
	        newItemCategory: '',
	        newItemLocation: '',
	        newItemPrice: '',

        };
    },
    mounted() {
        this.getItems();
        this.getCategories();
        this.getLocations();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
	    createItem() {
            return axios.post('/api/items', {
	                name: this.newItemName,
	                category: this.newItemCategory,
	                location: this.newItemLocation,
	                price: this.newItemPrice,
	            })
                .then(this.getItems)
                .then(() => {
	                this.newItemName = ''
	                this.newItemCategory = ''
	                this.newItemLocation = ''
	                this.newItemPrice = ''
                })
                .catch(console.error);
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        },
	    getCategories() {
		    return axios.get('/api/categories')
			    .then(response => {
				    this.categories = response.data;
			    }).catch(console.error);
	    },
	    getLocations(){
		    return axios.get('/api/locations')
			    .then(response => {
				    this.locations = response.data;
			    }).catch(console.error);
	    }
    }
}
</script>

<style>
.create-location-form {
    margin-bottom: 10px;
}
</style>