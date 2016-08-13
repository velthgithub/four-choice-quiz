import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
import { answerQuestion, nextQuestion } from '../actions';
import Question from '../components/Question';

class Questions extends React.Component {

	render() {
		let { questions } = this.props;
		console.log(questions);
		return (
			<div>
				{questions.map( (question, index) =>
					<Question
						key={index}
						{...question}
					/>
				)}
			</div>
		);
	}
}


const mapStateToProps = (state) => {
	return {
		questions: state.request.questions
	}
}



const mapDispatchToProps = (dispatch) => {
	return {
		onOptionClick: (id) => {
			dispatch(answerQuestion(id))
		},
		onNextClick: (index) => {
			dispatch(nextQuestion(index))
		}
	}
}

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(Questions)

