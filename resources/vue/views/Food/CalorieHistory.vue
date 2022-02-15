<template>
    <div>

        <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">

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
                                  :data="calorieHistories">

                            <el-table-column label="Date"
                                             prop="date"
                                             width="200px">
                            </el-table-column>
                            <el-table-column label="Calories"
                                             prop="calories"
                                             width="200px">
                                <template v-slot="{row}">
                                    {{ row.calories }} kcal
                                </template>
                            </el-table-column>
                            <el-table-column label="Calories"
                                             prop="calories"
                                             min-width="200px">
                                <template v-slot="{row}">
                                    <span v-if="row.calories <= calorieLimit" class="text-success">The calorie limit wasn't exceeded</span>
                                    <span v-if="row.calories > calorieLimit" class="text-danger">The calorie limit was exceeded</span>
                                </template>
                            </el-table-column>
                        </el-table>

                    </b-card>
                </b-col>
            </b-row>
            <!--End tables-->
        </b-container>

    </div>
</template>
<script>
import {format, subMonths} from 'date-fns';
import {Table, TableColumn} from 'element-ui'
import statsRepository from "@/repositories/foodEntry/statsRepository";


export default {
    components: {
        [Table.name]: Table,
        [TableColumn.name]: TableColumn
    },
    data() {
        return {
            dateFrom: null,
            dateTo: null,
            calorieHistories: [],
            calorieLimit: 2100,
        };
    },
    methods: {
        filter() {
            this.getCalorieHistory();
        },
        setDates() {
            let today = format(new Date(), 'YYYY-MM-DD');
            this.dateTo = today;
            this.dateFrom = format(subMonths(today, 1), 'YYYY-MM-DD');
        },
        getCalorieHistory() {
            statsRepository.caloriesForToday().then(response => {
                this.calorieLimit = response.data.calorie_limit;
            });
            statsRepository.caloriesByDay(
                format(this.dateFrom, 'DD.MM.YYYY'),
                format(this.dateTo, 'DD.MM.YYYY')
            ).then((response) => {
                this.calorieHistories = response.data;
            });
        },
    },
    mounted() {
        this.setDates();
        this.getCalorieHistory();
    }
};
</script>
