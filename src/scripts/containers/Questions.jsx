import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
import { answerQuestion, nextQuestion } from '../actions';
import Question from '../components/Question';


class Questions extends React.Component {

	questionStateClassName( current, index ) {
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

	getCurrentPositon() {
		let { current } = this.props;
		return - 1 * 100 * current;
	}

	isLast( index ) {
		let { questions } = this.props;
		let result = ( questions.length == index + 1 );
		return result;
	}

	render() {
		let { questions, current, onNextClick, onOptionClick } = this.props;
		let position = - 1 * 100 * current;
		return (
			<div
				className="four-choice-quiz-questions"
				style={{
					transform: 'translateX(' + position +  '%)'
				}}
			>
				{questions.map( (question, index) =>
					<Question
						className={'four-choice-quiz-questions__question ' + this.questionStateClassName(current, index)}
						key={index}
						questionID={index}
						isLast={this.isLast(index)}
						onOptionClick={onOptionClick}
						onNextClick={() => onNextClick(index)}
						{...question}
					/>
				)}

			</div>
		);
	}
}


const mapStateToProps = (state) => {
	return {
		questions: state.questions,
		current: state.screen.current
	}
}



const mapDispatchToProps = (dispatch) => {
	return {
		onOptionClick: (questionID, optionID) => {
			dispatch(answerQuestion( questionID, optionID + 1) )
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

