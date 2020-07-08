<template>
    <div class="card">
        <div class="card-header">
            <span style="font-size: 1.25rem; font-weight: 600">Places</span>
        </div>

        <div class="card-body">
            <div class="mb-2">
                <router-link :to="{name: 'create'}" class="btn btn-primary">Add new place</router-link>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(place, index) in places" :key="place.id">
                            <td>{{ index + 1}}</td>
                            <td>{{ place.name }}</td>
                            <td>{{ place.latitude }}</td>
                            <td>{{ place.longitude }}</td>
                            <td>
                                <div class="btn-group">
                                    <router-link :to="{name:'detail', params:{id: place.id}}" class="btn btn-sm btn-primary">Detail</router-link>
                                    <router-link :to="{name:'edit', params:{id: place.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                    <button class="btn btn-sm btn-danger" @click="deletePlace(place.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                places: []
            }
        },
        created() {
            let uri = '/api/places';
            this.axios.get(uri).then(response => {
                this.places = response.data.data;
            });
        },
        methods: {
            deletePlace(id) {
                this.$swal.fire({
                    title: 'Are you sure want to delete this place?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                }).then(result => {
                    if(result.value) {
                        let uri = `/api/place/delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            if(response.data.status == 200) {
                                this.places.splice(this.places.indexOf(id), 1);
                                this.$swal.fire({
                                    title: 'Place deleted',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            } else {
                                this.$swal.fire({
                                    title: 'Delete failed',
                                    icon: 'error',
                                });
                            }
                        });

                    }
                });
            }
        }
    }
</script>