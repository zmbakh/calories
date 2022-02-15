<template>
    <div>

        <base-header class="pb-6 pb-6 pt-5 pt-md-8 bg-gradient-success">
            <!-- Card stats -->
            <b-row>
                <b-col xl="3" md="6">
                    <stats-card title="Entities added this week"
                                type="gradient-red"
                                :sub-title="currentWeek"
                                icon="ni ni-active-40"
                                class="mb-4">

                        <template slot="footer">
                            <span class="text-success mr-2">{{ countDifference }}</span>
                            <span class="text-nowrap" v-if="countDifference === 0">Equal count of entities were added for two weeks</span>
                            <span class="text-nowrap" v-if="countDifference !== 0">{{ isCurrentWeekMore ? 'more entities added this week' : 'less entities added this week' }}</span>
                        </template>
                    </stats-card>
                </b-col>
                <b-col xl="3" md="6">
                    <stats-card title="Entities added the previous week"
                                type="gradient-orange"
                                :sub-title="previousWeek"
                                icon="ni ni-chart-pie-35"
                                class="mb-4">

                        <template slot="footer">
                            <br>
                        </template>
                    </stats-card>
                </b-col>
                <b-col xl="3" md="6">
                    <stats-card title="Average entities per user this week"
                                type="gradient-green"
                                :sub-title="averageCalories"
                                icon="ni ni-money-coins"
                                class="mb-4">

                        <template slot="footer">
                            <br>
                        </template>
                    </stats-card>

                </b-col>
            </b-row>
        </base-header>

    </div>
</template>
<script>
import StatsCard from '@/components/Cards/StatsCard';
import reportsRepository from "@/repositories/admin/reports/reportsRepository";

export default {
    components: {
        StatsCard,
    },
    data() {
        return {
            averageCalories: null,
            currentWeek: null,
            previousWeek: null,
        };
    },
    computed: {
        isCurrentWeekMore() {
            return this.currentWeek > this.previousWeek;
        },
        countDifference() {
            return Math.abs(this.currentWeek - this.previousWeek);
        }
    },
    methods: {
        getAverageCalories() {
            reportsRepository.averageCalories().then(response => {
                this.averageCalories = response.data.average_calories.toString();
            });
        },
        getEntitiesAdded() {
            reportsRepository.entitiesAdded().then(response => {
                this.currentWeek = response.data.current_week.toString();
                this.previousWeek = response.data.previous_week.toString();
            });
        }
    },
    mounted() {
        this.getAverageCalories();
        this.getEntitiesAdded();
    }
};
</script>
<style>
.el-table .cell{
    padding-left: 0px;
    padding-right: 0px;
}
</style>
