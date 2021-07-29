<template>
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex">
            <img :src="movie[0].posterurl" alt="Movie name" class="w-60">
            <div class="ml-24">

                <h4 class="font-semibold">{{movie[0].title}} ({{movie[0].year}})</h4>


                <span class="text-gray-400 mt-5">Rating: {{movie[0].ratingScore}}%</span>
                <span class="mx-2">,</span>
                <span class="text-gray-400 mt-5">Released: {{movie[0].releaseDate}}</span>
                <span class="mx-2">,</span>
                <span class="text-green-400 mt-5" >Genre{{movie[0].genres}}</span>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured cast</h4>
                    <div class="flex mt-4">
                        <div v-for="actor in movie[0].actors" :key="actor">
                        {{ actor}}
                        </div>
                    </div>

                </div>

            </div>


        </div>
        <div class="container container mx-auto px-4 py-16 flex">
        <div>
        <p class="text-green-400 mt-2">Storyline</p>
        <p class="text-gray-400 mt-4">{{movie[0].storyline}}</p>
        </div>
        </div>

    </div>

</template>


<script>
    export default {
        data() {
            return {
                movie: [],
            }
        },
        created() {
            this.axios
                .get(`https://movie-katana.herokuapp.com/api/movies/${this.$route.params.id}`)
                .then((response) => {
                    this.movie = response.data;
                    console.log(this.movie);
                });
        }
    }
</script>
