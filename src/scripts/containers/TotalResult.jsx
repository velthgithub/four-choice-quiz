import React, { PropTypes } from 'react'
import { connect } from 'react-redux'

const isTotalResult = function ( current, index ) {
	if( current == index ){
		return 'active';
	}
	return 'deactive'
}

const TotalResult = ({ questions, current }) => {
	return (
		<div className={ isTotalResult(questions.length, current) }>
			<h3>結果</h3>
		</div>
	)
}

export default TotalResult



const mapStateToProps = (state) => {
	return {
		questions: state.questions,
		current: state.screen.current
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
