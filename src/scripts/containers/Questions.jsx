import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
import { answerQuestion, nextQuestion } from '../actions';
import Question from '../components/Question';
import Result from '../containers/Result';

const questionStateClassName = function ( current, index ) {
	if( current == index ){
		return 'current';
	}
	else if( current > index ) {
		return 'prev'
	}
	else {
		return 'next'
	}
}

class Questions extends React.Component {

	render() {
		let { questions, current, onNextClick } = this.props;
		return (
			<div>
				{questions.map( (question, index) =>
					<Question
						className={questionStateClassName(current, index)}
						key={index}
						onNextClick={() => onNextClick(index)}
						{...question}
					/>
				)}

				<Result />
			</div>
		);
	}
}


const mapStateToProps = (state) => {
	return {
		questions: state.questions.questions,
		current: state.screen.current
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

