import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
import { answerQuestion, nextQuestion } from '../actions';
import Question from '../components/Question';
import TotalResult from '../containers/TotalResult';




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

	isLast( index ) {
		let { questions } = this.props;
		return ( questions.length === index + 1 );
	}

	render() {
		let { questions, current, onNextClick, onOptionClick } = this.props;
		return (
			<div>
				{questions.map( (question, index) =>
					<Question
						className={this.questionStateClassName(current, index)}
						key={index}
						questionID={index}
						isLast={this.isLast(index)}
						onOptionClick={onOptionClick}
						onNextClick={() => onNextClick(index)}
						{...question}
					/>
				)}

				<TotalResult />
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

