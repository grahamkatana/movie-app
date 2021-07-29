<template>
    <div class="container px-4">
            <nav class="border-b border-gray-800">
                <div class="container mx-auto flex items-center justify-between px-4 py-8">
                    <ul class="flex items-center">

                        <li>
                         <router-link to="/" class="hover:text-gray-300 text-green-500  font-bold"><h3>Home</h3></router-link>
                    
                        </li>
                      
                    </ul>
                    <div class="flex items-center">
                        <div class="relative">
                         
            
                           
                        </div>
                    </div>

                </div>

            </nav>
            <router-view></router-view>

        </div>
</template>
<script>
    export default {
         data() {
            return {
               
            
            }
        },

    }
</script>