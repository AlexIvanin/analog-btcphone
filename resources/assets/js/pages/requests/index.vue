<template>

  <div class="dashboard">
     <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">BTCPHONE</a>
  
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Выход</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
				    <router-link :to="{ name: 'home' }" class="nav-link">
        		   <span data-feather="home"></span>
                  Главная <span class="sr-only">(current)</span>
     				 </router-link>
                
              </li>
                <li class="nav-item">
				    <router-link :to="{ name: 'settings' }" class="nav-link">
        		   <span data-feather="home"></span>
                  Настройки <span class="sr-only">(current)</span>
     				 </router-link>
                
              </li>
                <li class="nav-item">
				    <router-link :to="{ name: 'requests' }" class="nav-link">
        		   <span data-feather="home"></span>
                  Заказы <span class="sr-only">(current)</span>
     				 </router-link>
                
              </li>
              
            </ul>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">


          <h2>Заявки</h2>
            <div id="">
                <div class="container-fluid">
    <!-- Main table element -->
    <b-table show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >
      <template slot="status" slot-scope="row">
          <span v-if="row.item.status == 0">Не оплачен</span>
           <span v-else>Оплачен</span>
      </template>
      <template slot="actions" slot-scope="row">
        <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->

        <router-link :to="{ name: 'requestsID', params: { id: row.item.id }}" class="btn mr-1 btn-secondary btn-sm">Редактировать</router-link>
      </template>

    </b-table>
 <b-col md="12" class="my-1">
        <b-pagination v-if="items" :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
                </div>
            </div>
        </main>
      </div>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios'
import Cookies from 'js-cookie'

export default {
    data: () => ({
         items: [],
         totalRows:0,
         fields: [
        { key: 'phone', label: 'Номер телефона'},
        { key: 'session', label: 'Сессия'},
        { key: 'status', label: 'Статус' },
        { key: 'summBTC', label: 'Сумма в BTC' },
        { key: 'summRUB', label: 'Сумма в RUB' },
        { key: 'actions', label: '' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows:1,
      sortBy: null,
      sortDesc: false,
      filter: null,
    }),
    layout: 'home',
    computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },
  methods:{
       onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    }
  },
    async mounted () {
        const { data } = await axios.get('/api/requests')
        console.log(data);
        this.items = data;
        this.totalRows = data.length
    },
    metaInfo () {
        return { title: this.title }
    }
}
</script>
<style>
body {
  font-size: .875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 48px; /* Height of navbar */
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.router-link-exact-active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.router-link-exact-active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

/*
 * Utilities
 */

.border-top { border-top: 1px solid #e5e5e5; }
.border-bottom { border-bottom: 1px solid #e5e5e5; }
</style>
