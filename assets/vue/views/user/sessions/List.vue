<template>
  <div v-if="sessions.length" class="grid">
<!--    {{ status }}-->
    <SessionCardList :sessions="sessions" />
  </div>
  <div v-else>
    <div class="bg-gradient-to-r from-gray-100 to-gray-50 flex flex-col rounded-md text-center p-2">
      <div class="p-10 text-center">
        <div>
          <v-icon
            icon="mdi-book-open-page-variant"
            size="72px"
            class="font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-ch-primary to-ch-primary-light"
          />
        </div>

        <div class="mt-2 font-bold">
          You don't have any session yet.
        </div>
        <div>
          Go to "Explore" to find a topic of interest, or wait for someone to subscribe you.
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import SessionCardList from '../../../components/session/SessionCardList.vue';
import {ref, computed} from "vue";
import {useStore} from 'vuex';
import gql from "graphql-tag";
import {useQuery, useResult} from '@vue/apollo-composable'
import {GET_SESSION_REL_USER} from "../../../graphql/queries/SessionRelUser.js";

export default {
  name: 'SessionList',
  components: {
    SessionCardList,
  },
  setup() {
    const store = useStore();
    let user = computed(() => store.getters['security/getUser']);

    if (user.value) {
      let userId = user.value.id;

      const {result, loading} = useQuery(GET_SESSION_REL_USER, {
        user: "/api/users/" + userId
      }, );

      const sessions = useResult(result, [], (data) => {
        return data.sessionRelUsers.edges.map(function(edge) {
          return edge.node.session;
        });
      });

      return {
        sessions,
        loading
      }
    }
  }
}

</script>
