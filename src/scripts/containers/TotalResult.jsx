import React, { PropTypes } from 'react'
import { connect } from 'react-redux'

class TotalResult extends React.Component {

	isTotalResult () {
		let { questions, current } = this.props;
		return ( questions.length == current );
	}

	getPoint() {
		let { questions } = this.props;

		return questions.filter( this.isCorrect ).length;
	}

	isCorrect( question ) {

		return ( question.answer == question.userAnswer )
	}

	getResultImagePath() {
		let { resultImages } = this.props;
		let images = resultImages.filter( ( image ) => {
			return image.threshold <= this.getPoint()
		} );

		if( images.length > 0 ) {
			let image = images[images.length - 1];
			return image.image;
		}

		return '';
	}

	render() {
		let src = this.getResultImagePath();
		let { questions } = this.props;
		let point = this.getPoint();
		let total = questions.length;
		let className = ( this.isTotalResult() ? 'active' : 'deactive' );
		return (
			<div
				className={className}
			>
				<h3>結果</h3>
				<img src={src} alt=""/>
				<div className="points">{ point } / { total }</div>

			</div>
		)
	}
}

const mapStateToProps = (state) => {
	return {
		questions: state.questions,
		current: state.screen.current,
		resultImages: state.resultImages,
	}
}



const mapDispatchToProps = (dispatch) => {
	return {
	}
}

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(TotalResult)
