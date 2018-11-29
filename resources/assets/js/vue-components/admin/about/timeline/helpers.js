import {store} from './store';

export default {

    getIndexOfTimeline(timelineId) {
        return _.findIndex(store.state.timelines, function (timeline) {
            return timeline.id === timelineId;
        });
    },
}