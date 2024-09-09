<template>
        <div class="container mx-auto px-4 pt-2 ">

            <div class="popular-movies">
                <!--Movies top section------------------------------------------->
                            <div class="container mx-auto flex items-center justify-between px-4 py-6">
                    <ul class="flex items-center">




                         <li class="">
                            <a class="font-bold hover:text-gray-300" href="#" v-on:click="toggle=!toggle">Layout</a>

                        </li>
                        <li>
                        <div v-if="toggle==true">
                        <p class="ml-5 font-bold">List</p>
                        </div>

                        <div v-if="toggle==false">
                        <p class="ml-5 font-bold"> Grid</p>
                        </div>
                        </li>
                        <li>
                           <h4 v-text="result" class="ml-20 hover:text-gray-300 text-green-500"></h4>
                        </li>

                    </ul>
                    <div class="flex items-center">
                        <div class="relative">
                         <div class="container mt-2">
        <input type="text" placeholder="Search Title" v-model="query" class="focus:outline-none focus:shadow-outline bg-gray-800 rounded-full w-100 px-4 py-1">


        </div>


                        </div>
                    </div>

                </div>
                <!--Movies top section end------------------------------------------->

                <!--Movies display section end------------------------------------------->
           <div class="movies">

                <!--Movies grid showcase------------------------------------------->
               <div v-if="toggle==false">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">


                    <div v-for="movie in movies" :key="movie.id">
                    <div class="mt-8">
                     <router-link :to="{name: 'show', params: { id: movie.id }}" class="hover:opacity-70">
                     <img  :src="movie.posterurl" class="h-96 hover:opacity-70" :alt="movie.title">
                        </router-link>

                        <div class="mt-2">
                         <router-link :to="{name: 'show', params: { id: movie.id }}" class="text-lg mt-2 text-green-400 hover:text-gray-400"><h5>{{movie.title}} ({{movie.year}})</h5>
                        </router-link>

                            <div class="flex items-center text-gray-400">
                                <span>Released : {{movie.releaseDate}} </span>
                            </div>
                            <div class="text-gray-400">
                                Genre: {{movie.genres}}

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
               </div>
                <!--Movies grid showcase end------------------------------------------->

                <!--Movies cols showcase------------------------------------------->
                <div v-if="toggle==true" class="border-b border-gray-800">
              <div class="listMovies"  v-for="movie in movies" :key="movie.id">
                        <div class="container mx-auto px-4 py-16 flex">
                        <router-link :to="{name: 'show', params: { id: movie.id }}" class="hover:opacity-70">
                     <img  :src="movie.posterurl" class="h-46 hover:opacity-70" :alt="movie.title">
                        </router-link>
            <div class="ml-24">

                <router-link :to="{name: 'show', params: { id: movie.id }}" class="text-lg mt-2 text-green-400 hover:text-gray-400"><h4>{{movie.title}} ({{movie.year}})</h4>
                        </router-link>


                <span class="text-gray-400 mt-5">Rating: {{movie.ratingScore}}%</span>
                <span class="mx-2">,</span>
                <span class="text-gray-400 mt-5">Released: {{movie.releaseDate}}</span>
                <span class="mx-2">,</span>
                <span class="text-green-400 mt-5" >Genre{{movie.genres}}</span>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured cast</h4>
                    <div class="flex mt-4">
                        <div v-for="actor in movie.actors" :key="actor">
                        {{actor}}
                        </div>
                    </div>

                </div>

            </div>


        </div>
              </div>

                </div>

                <!--Movies cols showcase end------------------------------------------->

           </div>
           <!--Movies display section end------------------------------------------->
            </div>

        </div>

</template>

<script>
    export default {
        data() {
            return {
                movies: [],
                temp:[],
                query:'',
                result:'',
                toggle:false,
            }
        },
        created() {
            this.axios
                .get('http://127.0.0.1:8000/api/movies')
                .then(response => {
                    console.log(response.data)
                    this.movies = response.data
                    this.temp=response.data
                });
        },
        methods: {
            searchMovie(query) {
                this.axios
                    .get(`http://127.0.0.1:8000/api/movies/search/${query}`)
                    .then(response => {
                         console.log(response.data)
                         this.movies = response.data;
                         this.result='Search results...'

                    });
            },
        },
        watch: {
            query:function(val){

                if(val===''){
                    this.movies=this.temp
                     this.result=''

                }
                else{
                    this.searchMovie(val)


                }
            }

        },
    }
</script>
