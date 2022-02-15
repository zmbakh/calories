<template>
    <div>

        <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
            <!-- Card stats -->
            <b-row>
                <CaloriesForToday />
                <MoneySpent />
            </b-row>
        </base-header>

        <!--Charts-->
        <b-container fluid class="mt--7">
            <!--Tables-->
            <b-row class="sm-6">
                <b-col xl="8" class="mb-5 mb-xl-0">
                    <b-row class="form-group">
                        <b-col md="6" lg="4" xl="3">
                            <base-input label="Date From" type="date" v-model="dateFrom"/>
                        </b-col>
                        <b-col md="6" lg="4" xl="3">
                            <base-input label="Date To" type="date" v-model="dateTo"/>
                        </b-col>
                        <b-col md="6" lg="4" xl="3" class="mt-lg-4 pt-lg-2">
                            <base-button block type="primary" @click="filter">Filter</base-button>
                        </b-col>
                    </b-row>
                    <b-card no-body>
                        <b-card-header class="border-0">
                            <h3 class="mb-0">Food Entries List</h3>
                        </b-card-header>

                        <el-table class="table-responsive table"
                                  header-row-class-name="thead-light"
                                  :data="foodEntries">
                            <el-table-column label="Name"
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
                                    ${{ row.price }}
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
// Components
import StatsCard from '@/components/Cards/StatsCard';
import {format} from 'date-fns';
import foodEntryRepository from "@/repositories/foodEntry/foodEntryRepository";
import {Table, TableColumn} from 'element-ui'
import CaloriesForToday from "@/views/Stats/CaloriesForToday";
import MoneySpent from "@/views/Stats/MoneySpent";


export default {
    components: {
        StatsCard,
        CaloriesForToday,
        MoneySpent,
        [Table.name]: Table,
        [TableColumn.name]: TableColumn
    },
    data() {
        return {
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
                date_from: format(this.dateFrom, 'DD.MM.YYYY'),
                date_to: format(this.dateTo, 'DD.MM.YYYY'),
            }).then((response) => {
                this.foodEntries = response.data;
                this.currentPage = response.meta.current_page;
                this.perPage = response.meta.per_page;
                this.total = response.meta.total;
            });
        },
    },
    mounted() {
        this.setDates();
        this.getFoodEntries();
    }
};
</script>
