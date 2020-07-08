<template>
    <div class="card">
        <div class="card-header">
            <span style="font-size: 1.25rem; font-weight: 600">Edit place</span>
        </div>

        <div class="card-body">
            <form @submit.prevent="updatePlace">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" v-model="place.name" required>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="latitude" v-model="place.latitude" required>
                    </div>

                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="longitude" v-model="place.longitude" required>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary">Save</button>
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
        created() {
            let uri = `/api/place/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {
                if(response.data.status == 200) {
                    this.place = response.data.data;
                } else {
                    this.$router.push({name: 'index'});

                    this.$swal.fire({
                        title: 'Place not found',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            });
        },
        methods: {
            updatePlace(e) {
                if(this.$data.place.name != null && this.$data.place.latitude != null && this.$data.place.longitude != null) {
                    let uri = `/api/place/update/${this.$route.params.id}`;
                    this.axios.put(uri, this.place).then(response => {
                        if(response.data.status == 200) {
                            this.$swal.fire({
                                title: 'Place updated',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                        } else {
                            
                            this.$swal.fire({
                                title: 'Place not found',
                                icon: 'error',
                                confirmButtonText: 'Close'
                            });
                        }

                        this.$router.push({name: 'index'});
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