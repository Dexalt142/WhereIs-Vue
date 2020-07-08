<template>
    <div class="card">
        <div class="card-header">
            <span style="font-size: 1.25rem; font-weight: 600">Add new place</span>
        </div>

        <div class="card-body">
            <div v-if="errors.length" class="alert alert-danger">
                <ul class="mb-0">
                    <li v-for="(error) in errors" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>
            <form @submit.prevent="createPlace">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" v-model="place.name">
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="latitude" v-model="place.latitude">
                    </div>

                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="longitude" v-model="place.longitude">
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary">Confirm</button>
                    <router-link :to="{name: 'index'}" class="btn btn-link">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                place: {},
                errors: [],
                name: null,
                latitude: null,
                longitude: null
            }
        },
        methods: {
            createPlace(e) {
                if(this.$data.place.name != null && this.$data.place.latitude != null && this.$data.place.longitude != null) {
                    let uri = "/api/place/store";
                    this.axios.post(uri, this.place).then(response => {
                        if(response.data.status == 201) {
                            this.$swal.fire({
                                title: 'A new place has added',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                            this.$router.push({name: 'index'});
                        } else {
                            this.$swal.fire({
                                title: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'Close'
                            });
                        }
                    });

                    return true;
                }

                this.errors = [];

                if(!this.name) {
                    this.errors.push("Enter a valid name");
                }

                if(!this.latitude) {
                    this.errors.push("Enter a valid latitude");
                }

                if(!this.longitude) {
                    this.errors.push("Enter a valid longitude");
                }

                e.preventDefault();
            }
        }
    }
</script>