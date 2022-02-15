<template>
    <div>

        <base-header class="pb-6 pb-8 pt-5 pt-md-6 bg-gradient-success">
            <!-- Card stats -->
            <b-row>
            </b-row>
        </base-header>

        <!--Charts-->
        <b-container fluid class="mt--7">
            <!--Tables-->
            <b-row class="sm-6">
                <b-col xl="12" class="mb-5 mb-xl-0">
                    <b-row class="form-group">
                        <b-col md="6" lg="2">
                            <base-input label="User">
                                <select class="form-control" v-model="userId">
                                    <option value="">All</option>
                                    <option v-for="user in users" v-bind:value="user.id">
                                        {{ user.name }} {{ user.last_name}}
                                    </option>
                                </select>
                            </base-input>
                        </b-col>
                        <b-col md="6" lg="2">
                            <base-input label="Date From" type="date" v-model="dateFrom"/>
                        </b-col>
                        <b-col md="6" lg="2">
                            <base-input label="Date To" type="date" v-model="dateTo"/>
                        </b-col>
                        <b-col md="6" lg="2" class="mt-lg-4 pt-lg-2">
                            <base-button block type="primary" @click="filter">Filter</base-button>
                        </b-col>
                    </b-row>
                    <b-card no-body>
                        <b-card-header class="border-0">
                            <div class="float-md-right">
                                <router-link :to="{name: 'admin-food-entries-create'}" class="btn base-button btn-success">Add Entry</router-link>
                            </div>
                            <h3 class="mb-0">Food Entries List</h3>
                        </b-card-header>

                        <el-table class="table-responsive table"
                                  header-row-class-name="thead-light"
                                  :data="foodEntries">
                            <el-table-column label="User"
                                             min-width="140px">
                                <template v-slot="{row}">
                                    {{ row.user.name }} {{ row.user.last_name }}
                                </template>
                            </el-table-column>

                            <el-table-column label="Food Name"
                                             prop="name"
                                             min-width="140px">
                            </el-table-column>

                            <el-table-column label="Calories"
                                             prop="calories"
                                             min-width="140px">
                                <template v-slot="{row}">
                                    {{ row.calories }} kcal
                                </template>
                            </el-table-column>

                            <el-table-column label="Price"
                                             prop="price"
                                             min-width="140px">
                                <template v-slot="{row}">
                                    <span v-if="row.price !== null">${{ row.price }}</span>
                                </template>
                            </el-table-column>

                            <el-table-column label="Time"
                                             prop="date_time"
                                             min-width="140px">
                            </el-table-column>
                        </el-table>

                        <b-card-footer class="py-4 d-flex justify-content-end">
                            <base-pagination v-model="currentPage" :per-page="perPage" :total="total"
                                             @change="paginate"></base-pagination>
                        </b-card-footer>
                    </b-card>
                </b-col>
            </b-row>
            <!--End tables-->
        </b-container>

    </div>
</template>
<script>
import {format} from 'date-fns';
import {Table, TableColumn} from 'element-ui'
import userRepository from "@/repositories/admin/user/userRepository";
import foodEntryRepository from "@/repositories/admin/food/foodEntryRepository";


export default {
    components: {
        [Table.name]: Table,
        [TableColumn.name]: TableColumn
    },
    data() {
        return {
            userId: '',
            users: [],
            dateFrom: null,
            dateTo: null,
            foodEntries: [],
            currentPage: 1,
            perPage: 15,
            total: 1,
        };
    },
    methods: {
        paginate(page) {
            this.currentPage = page;
            this.getFoodEntries();
        },
        filter() {
            this.currentPage = 1;
            this.getFoodEntries();
        },
        setDates() {
            let today = format(new Date(), 'YYYY-MM-DD');
            this.dateFrom = today;
            this.dateTo = today;
        },
        getFoodEntries() {
            foodEntryRepository.index(this.currentPage, {
                user_ids: this.userId ? [this.userId] : null,
                date_from: format(this.dateFrom, 'DD.MM.YYYY'),
                date_to: format(this.dateTo, 'DD.MM.YYYY'),
            }).then((response) => {
                this.foodEntries = response.data;
                this.currentPage = response.meta.current_page;
                this.perPage = response.meta.per_page;
                this.total = response.meta.total;
            });
        },
        getUsers() {
            userRepository.index().then(response => {
                this.users = response.data;
            });
        }
    },
    mounted() {
        this.setDates();
        this.getUsers();
        this.getFoodEntries();
    }
};
</script>
