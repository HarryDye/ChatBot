<template>
  <form action="/" method="post" >
    <input type="text" name="text" id="text" v-model="newMessage" @keyup.enter="postMessage">
    <input type="submit" onclick="postMessage()" @click="postMessage">
  </form>
</template>

<script>
    export default {
      data() {
        return {
          newMessage: ''
        }
      },

      methods: {
         postMessage() {
           this.$emit('messageSent', this.newMessage);
           this.newMessage = '';
        }
      }
    }
</script>
