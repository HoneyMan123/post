
<!----><template>
    <AuthenticatedLayout  >
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Profile</h2>
      </template>
      <div class="flex h-screen flex-col items-center">
        <button id="buttonPostCreate" class="dark:text-gray-200 font-semibold text-[30px]">CREATE POST</button>
<!--    <textarea class="a   break-word whitespace-pre-wrap  " ></textarea>-->
     <!--<div class="post flex  mt-20 bg-white h-[100px] w-[300px]" v-for="post in posts">{{ post.postValue }}</div>-->
      <textarea class="a   break-word whitespace-pre-wrap m-2 h-[100px]] w-[550px] " v-for="post in posts">{{ post.postValue }}</textarea>
    </div>







    </AuthenticatedLayout>
  </template>








<!----><script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
export default {
    data() {
        return {
            posts: []
        }
    },
    mounted() {
        this.fetchPosts()
    },
    methods: {
        fetchPosts() {
    axios.get('api/profile')
        .then(response => {
            this.posts = response.data;
        })
        .catch(error => console.log(error))
}
    }
}
</script>


<script setup>
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';


onMounted(() => {
  const postCreate = document.getElementById('buttonPostCreate');







postCreate.addEventListener('click', function (e) {
e.preventDefault();
    postCreate.insertAdjacentHTML('afterend', '        <form class="form flex flex-row" id="formSubmit" action="postSubmision"   >     <textarea name="inputForm" class="input  h-[150px] w-[550px]" type="text"></textarea> <input class="bg-white h-[150px]" type="submit"></form>')
   //postCreate.insertAdjacentHTML('afterend','<div class="post bg-white h-[100px] w-[300px]"></div>')
    postCreate.disabled = true;
const formSubmit = document.getElementById('formSubmit');
formSubmit.addEventListener('click', function(e){
}
)
  });
});
</script>
-->
