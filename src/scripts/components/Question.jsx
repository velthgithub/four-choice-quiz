import React, {PropTypes} from 'react'
import Option from './Option';
import Result from './Result'
import NextButton from './NextButton'



class Question extends React.Component {

	isAnswered() {
		let {userAnswer} = this.props;
		return !( userAnswer === undefined || userAnswer === null );
	}

	isCorrect() {
		let {userAnswer, answer} = this.props;
		return ( answer === userAnswer );
	}

	render() {
		let {question, comment, options, className, isLast, onNextClick, onOptionClick, questionID, userAnswer, answer} = this.props;

		return (
			<div className={'four-choice-quiz-question ' + className}>
				<h3>{question}</h3>
				<ol className="four-choice-quiz-question__options">
					{options.map((option) =>
						<Option
							key={option.index}
							onClick={() => onOptionClick(questionID, option.index)}
							isAnswered={this.isAnswered()}
							isSelected={(userAnswer == option.index + 1)}
							isCorrect={(answer == option.index + 1)}
						>
							{option.value}
						</Option>
					)}
				</ol>
				<Result
					isAnswered={this.isAnswered()}
					isCorrect={this.isCorrect()}
				/>
				<p
					style={{
						display: this.isAnswered() ? 'block' : 'none'
					}}
				>{comment}</p>
				<NextButton
					onClick={onNextClick}
					isLast={isLast}
					isAnswered={this.isAnswered()}
				/>

			</div>
		)
	}
}

export default Question
