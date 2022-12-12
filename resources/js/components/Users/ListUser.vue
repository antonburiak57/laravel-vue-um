<template>
  <b-container>
    <b-row>
      <b-col cols="8">
        <h1>All Users</h1>
      </b-col>
      <b-col cols="4" class="ml-auto text-right">
        <b-button variant="outline-info" :to="{ name: 'AddUser' }">Add User</b-button>
      </b-col>
    </b-row>

    <b-row>
      <b-col cols="12">
        <b-table striped lg hover :items="users" :fields="fields">
          <template #cell(index)="data">
            {{ data.index + 1 }}
          </template>
          <template #cell(actions)="row">
            <b-button :to="{name: 'EditUser', params: {id: row.item.id}}" size="sm" variant="primary">Edit</b-button>
            <b-button @click="deleteUser(row.item.id)" size="sm" variant="danger">Delete</b-button>
          </template>
        </b-table>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="6" md="3" class="my-1">
        <b-form-group
          label="Per page"
          label-for="per-page-select"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="perPage"
            :options="pageOptions"
            size="sm"
            @change="changePerPage"
          ></b-form-select>
        </b-form-group>
      </b-col>
      <b-col sm="6" md="3" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
          @change="changePage"
        ></b-pagination>
      </b-col>
      <b-col md="6" class="my-1">
        <b-form-group
          label="Filter"
          label-for="filter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Type to Search"
              @change="changeFilter"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!filter" @click="clearFilter">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { User } from '../../services/user'
export default {
  data () {
    return {
      users: [],
      fields: [
        {
          key: 'index',
          label: 'No'
        },
        {
          key: 'first_name',
          label: 'FirstName',
          sortable: true
        }, {
          key: 'last_name',
          label: 'LastName',
          sortable: true
        }, {
          key: 'email',
          label: 'Email',
          sortable: true
        }, {
          key: 'gender',
          label: 'Gender',
          sortable: true
        }, {
          label: 'Degree',
          key: 'degree',
          sortable: true
        }, {
          label: 'Street',
          key: 'street',
          sortable: true
        }, {
          label: 'StreetNo',
          key: 'street_no',
          sortable: true
        }, {
          label: 'PostalCode',
          key: 'postal_code',
          sortable: true
        }, {
          label: 'City',
          key: 'city',
          sortable: true
        }, {
          label: 'Actions',
          key: 'actions'
        }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
      filter: ''
    }
  },
  created () {
    this.getUsers(this.currentPage, this.perPage, this.filter)
  },
  methods: {
    clearFilter() {
      this.filter = ''
      this.getUsers(this.currentPage, this.perPage, '')
    },
    changeFilter(value) {
      this.getUsers(this.currentPage, this.perPage, value)
    },
    changePerPage () {
      this.getUsers(this.currentPage, this.perPage, this.filter)
    },
    changePage (pageNumber) {
      this.getUsers(pageNumber, this.perPage, this.filter)
    },
    getUsers (currentPage, perPage, filter) {
      User.list(currentPage, perPage, filter).then(response => {
        this.users = response.data.data.data
        this.totalRows = response.data.data.total
      })
    },
    deleteUser (userId) {
      let e = confirm('Are you Sure to delete this user?')
      if (e) {
        User.delete(userId).then(response => {
          let index = this.users.findIndex(user => user.id === userId)
          this.users.splice(index, 1)
          this.$bvToast.toast(response.data.message, {
            title: 'Success',
            variant: 'success',
            solid: true
          })
        })
      }
    }
  }
}
</script>
