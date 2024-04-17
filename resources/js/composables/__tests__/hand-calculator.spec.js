import { useHandCalculator } from '../hand-calculator'; 
import { describe, it, expect } from 'vitest';

const { getHandName } = useHandCalculator();

describe('Hand calculator test suite', () => {
  it('should return highCard when the only applicable card is that', () => {
        const highCardHand = [
            { value: 2, suit: 'hearts', rank: 2 },
            { value: 3, suit: 'diamonds', rank: 3 },
            { value: 4, suit: 'hearts', rank: 4 },
            { value: 5, suit: 'clubs', rank: 5 },
            { value: 7, suit: 'spaces', rank: 7 },
        ];

        const result = getHandName(highCardHand);
        expect(result).toEqual('highCard');
  });

    it('should return pair when the only applicable card is that', () => {
            const pairHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'clubs', rank: 5 },
                { value: 7, suit: 'spaces', rank: 7 },
            ];
    
            const result = getHandName(pairHand);
            expect(result).toEqual('pair');
    });

    it('should return twoPair when the only applicable card is that', () => {
            const twoPairHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 4, suit: 'clubs', rank: 4 },
            ];
    
            const result = getHandName(twoPairHand);
            expect(result).toEqual('twoPair');
    });

    it('should return threeOfAKind when the only applicable card is that', () => {
            const threeOfAKindHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
            ];
    
            const result = getHandName(threeOfAKindHand);
            expect(result).toEqual('threeOfAKind');
    });

    it('should return straight when the only applicable card is that', () => {
            const straightHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 3, suit: 'diamonds', rank: 3 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'clubs', rank: 5 },
                { value: 6, suit: 'spades', rank: 6 },
            ];
    
            const result = getHandName(straightHand);
            expect(result).toEqual('straight');
    });

    it('should return flush when the only applicable card is that', () => {
            const flushHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 6, suit: 'hearts', rank: 6 },
                { value: 8, suit: 'hearts', rank: 8 },
                { value: 10, suit: 'hearts', rank: 'J' },
            ];
    
            const result = getHandName(flushHand);
            expect(result).toEqual('flush');
    });

    it('should return fullHouse when the only applicable card is that', () => {
            const fullHouseHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 4, suit: 'clubs', rank: 4 },
                { value: 4, suit: 'spaces', rank: 4 },
            ];
    
            const result = getHandName(fullHouseHand);
            expect(result).toEqual('fullHouse');
    });

    it('should return fourOfAKind when the only applicable card is that', () => {
            const fourOfAKindHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'diamonds', rank: 2 },
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 2, suit: 'clubs', rank: 2 },
            ];
    
            const result = getHandName(fourOfAKindHand);
            expect(result).toEqual('fourOfAKind');
    });

    it('should return straightFlush when the only applicable card is that', () => {
            const straightFlushHand = [
                { value: 2, suit: 'hearts', rank: 2 },
                { value: 3, suit: 'hearts', rank: 3 },
                { value: 4, suit: 'hearts', rank: 4 },
                { value: 5, suit: 'hearts', rank: 5 },
                { value: 6, suit: 'hearts', rank: 6 },
            ];
    
            const result = getHandName(straightFlushHand);
            expect(result).toEqual('straightFlush');
    });

    it('should return royalFlush when the only applicable card is that', () => {
            const straightFlushHand = [
                { value: 11, suit: 'hearts', rank: 14 },
                { value: 10, suit: 'hearts', rank: 13 },
                { value: 10, suit: 'hearts', rank: 12 },
                { value: 10, suit: 'hearts', rank: 11 },
                { value: 10, suit: 'hearts', rank: 10 },
            ];
    
            const result = getHandName(straightFlushHand);
            expect(result).toEqual('straightFlush');
    });
});