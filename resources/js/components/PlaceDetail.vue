<template>
    <div class="card">
        <div class="card-header">
            <span style="font-size: 1.25rem; font-weight: 600">{{ place.name }}</span>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" v-model="place.name" disabled>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label>Latitude</label>
                    <input type="text" class="form-control" id="latitude" v-model="place.latitude" disabled>
                </div>

                <div class="col-md-6">
                    <label>Longitude</label>
                    <input type="text" class="form-control" id="longitude" v-model="place.longitude" disabled>
                </div>
            </div>

            <div class="mb-2">
                <iframe :src="mapsUri" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>

            <div class="form-group mb-0">
                <router-link :to="{name: 'index'}" class="btn btn-primary">Return</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                place: {},
                mapsUri: ''
            }
        },
        created() {
            let uri = `/api/place/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {
                if(response.data.status == 200) {
                    this.place = response.data.data;
                    this.mapsUri = `https://maps.google.com/maps?q=${this.place.latitude},${this.place.longitude}&z=12&output=embed`;
                } else {
                    this.$router.push({name: 'index'});

                    this.$swal.fire({
                        title: 'Place not found',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            });
        }
    }
</script>