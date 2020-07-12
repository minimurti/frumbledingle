<template>
    <div>
	    <h3>Categories</h3>
	    <hr>
        <form @submit.prevent="createCategories">
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newCategoryName" type="text" class="form-control" placeholder="Category Name" />

	            <div class="input-group-prepend">
		            <span class="input-group-text">Parent</span>
	            </div>
	            <select v-model="categoryParent" class="form-control">
		            <option value="null">None</option>
		            <option v-for="category in categories" v-bind:value="category.id" v-bind:key="category.id">
			            {{category.name}}
		            </option>
	            </select>


                <div class="input-group-append">
                    <button class="btn btn-primary">Create Category</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Category Name</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.parent?row.parent.name:null }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteCategories(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            categories: [],
	        newCategoryName: '',
	        categoryParent: null,
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);
        },
        createCategories() {
            return axios.post('/api/categories', {name: this.newCategoryName, parent_id: this.categoryParent})
                .then(this.getCategories)
                .then(() => this.newCategoryName = '')
                .catch(console.error);
        },
        deleteCategories(id) {
            if(confirm("This will delete all items and belonging to this category as well as any child categories along with their corresponding items"))
            return axios.post('/api/categories/' + id, {_method: 'DELETE'})
                .then(this.getCategories)
                .catch(console.error);
        }
    }
}
</script>

<style>
.create-location-form {
    margin-bottom: 10px;
}
</style>