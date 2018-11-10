import {store} from './store';

export default {

    getApplicantItems(applicantId) {
        return _.findIndex(store.state.items, function (applicant) {
            return applicant.id === applicantId;
        });
    },
}