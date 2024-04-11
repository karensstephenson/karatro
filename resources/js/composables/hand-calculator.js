export function useHandCalculator() {
    // Assume you as passing an array of n cards (up to 5) in the form object { value: 2, suit: 'hearts', rank: '2 }
    // Each function listed below is in order of important, e.g. a 4 of a kind would override a full house
    // because four of a kind is deemed to be a better hand.

    // All of the functions below should return a boolean value, true if the hand is that type, false otherwise.

    // Straight flush: Five cards in a sequence, all in the same suit.
    const isStraightFlush = (cards) => {}

    // Four of a kind: Four cards of the same rank, and suit
    const isFourOfAKind = (cards) => {}

    // Full house: Three cards of one rank and two cards of another rank.
    const isFullHouse = (cards) => {}

    // Flush: Five cards of the same suit, not in sequence
    const isFlush = (cards) => {}

    // Straight: Five cards in a sequence, but not of the same suit.
    const isStraight = (cards) => {}

    // Three of a kind: Three cards of the same rank
    const isThreeOfAKind = (cards) => {}

    // Two pair: Two cards of one rank and two cards of another rank
    const isTwoPair = (cards) => {}

    // Pair: Two cards of the same rank
    const isPair = (cards) => {}

    // High card: Highest value card (last ditch saloon, if none of those above apply, this one will)
    const isHighCard = (cards) => {}


    const getHandName = (cards) => {
        // logic!
    }

    return {
        getHandName
    }
}