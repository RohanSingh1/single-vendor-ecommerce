<template>
   <div>
       <a href="">{{title}}</a>
       <a href="">{{description}}</a>
   </div>
</template>

<style>
    /* CSS used here will be applied after bootstrap.css */
.dropdown:hover>.dropdown-menu {
  display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}




</style>

<script>
export default {
        props:['title','description'],
        mounted() {
            console.log(this.title);
        },
}
</script>
